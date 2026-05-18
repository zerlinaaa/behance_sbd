"""
============================================================
BEHANCE SCRAPER LENGKAP — Laravel Ready
============================================================
Scrape:
- users             (owner project)
- projects          (+ dominant_color)
- project_images    (max 10 per project)
- categories        (Creative Fields)
- project_categories
- tools             (Adobe Photoshop, Figma, dll)
- project_tools

Generate dummy:
- likes
- follows
- bookmarks

Output: behance_data.json
Resume support: lanjut dari data yang sudah ada
============================================================
"""

import json, time, random, re, os
import uuid
import mysql.connector

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from selenium.common.exceptions import (
    TimeoutException, NoSuchElementException, StaleElementReferenceException,
    WebDriverException
)

try:
    from webdriver_manager.chrome import ChromeDriverManager
    USE_WDM = True
except ImportError:
    USE_WDM = False


# =========================
# CONFIG
# =========================
TARGET        = 700
OUTPUT_FILE   = "behance_data.json"
DELAY_MIN     = 2.5
DELAY_MAX     = 4.5
SCROLL_ROUNDS = 12
MAX_RETRY     = 3

DB_CONFIG = {
    'host':     'localhost',
    'user':     'root',
    'password': '',
    'database': 'behance_sbd'
}

DEFAULT_CATEGORIES = [
    ("Graphic Design",   "graphic-design"),
    ("Photography",      "photography"),
    ("Illustration",     "illustration"),
    ("UI/UX",            "ui-ux"),
    ("Branding",         "branding"),
    ("Motion",           "motion"),
    ("3D Art",           "3d-art"),
    ("Architecture",     "architecture"),
    ("Typography",       "typography"),
    ("Product Design",   "product-design"),
    ("Fashion",          "fashion"),
    ("Advertising",      "advertising"),
    ("Web Design",       "web-design"),
    ("Packaging",        "packaging"),
    ("Print",            "print"),
]

DEFAULT_TOOLS = [
    "Adobe Photoshop",
    "Adobe Illustrator",
    "Adobe InDesign",
    "Adobe After Effects",
    "Adobe Photoshop Lightroom",
    "Adobe XD",
    "Adobe Premiere Pro",
    "Adobe Dimension",
    "Figma",
    "Sketch",
    "Cinema 4D",
    "Blender",
    "Procreate",
    "Canva",
    "CorelDRAW",
]

SEARCH_QUERIES = [
    ("design",          "Graphic Design"),
    ("branding",        "Branding"),
    ("ui ux",           "UI/UX"),
    ("illustration",    "Illustration"),
    ("typography",      "Typography"),
    ("photography",     "Photography"),
    ("motion graphics", "Motion"),
]


# =========================
# DATABASE
# =========================
def get_db():
    return mysql.connector.connect(**DB_CONFIG)


def setup_categories(conn) -> dict:
    cursor = conn.cursor()
    cat_map = {}
    for name, slug in DEFAULT_CATEGORIES:
        try:
            cursor.execute("SELECT id FROM categories WHERE slug = %s", (slug,))
            row = cursor.fetchone()
            if row:
                cat_map[name.lower()] = row[0]
            else:
                cursor.execute("""
                    INSERT INTO categories (name, slug, is_active, projects_count, created_at, updated_at)
                    VALUES (%s, %s, 1, 0, NOW(), NOW())
                """, (name, slug))
                conn.commit()
                cat_map[name.lower()] = cursor.lastrowid
        except Exception as e:
            print(f"   ⚠ Category error ({name}): {e}")
            conn.rollback()
    cursor.close()
    print(f"✅ Categories ready: {len(cat_map)}")
    return cat_map


def setup_tools(conn) -> dict:
    cursor = conn.cursor()
    tool_map = {}
    for name in DEFAULT_TOOLS:
        slug = re.sub(r"[^a-z0-9]+", "-", name.lower()).strip("-")
        try:
            cursor.execute("SELECT id FROM tools WHERE slug = %s", (slug,))
            row = cursor.fetchone()
            if row:
                tool_map[name.lower()] = row[0]
            else:
                cursor.execute("""
                    INSERT INTO tools (name, slug, created_at, updated_at)
                    VALUES (%s, %s, NOW(), NOW())
                """, (name, slug))
                conn.commit()
                tool_map[name.lower()] = cursor.lastrowid
        except Exception as e:
            print(f"   ⚠ Tool error ({name}): {e}")
            conn.rollback()
    cursor.close()
    print(f"✅ Tools ready: {len(tool_map)}")
    return tool_map


def get_or_create_user(conn, username: str, name: str) -> int:
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM users WHERE username = %s", (username,))
        row = cursor.fetchone()
        if row:
            if name and name != "Unknown":
                cursor.execute(
                    "UPDATE users SET name = %s WHERE username = %s AND name = 'Unknown'",
                    (name, username)
                )
                conn.commit()
            return row[0]

        import bcrypt
        hashed = bcrypt.hashpw(b"password123", bcrypt.gensalt()).decode()
        cursor.execute("""
            INSERT INTO users (name, username, email, password, role, followers_count, following_count, created_at, updated_at)
            VALUES (%s, %s, %s, %s, 'user', 0, 0, NOW(), NOW())
        """, (
            name or username,
            username,
            f"{username}@behance-scraped.com",
            hashed
        ))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"   ⚠ DB error get_or_create_user: {e}")
        conn.rollback()
        return 1
    finally:
        cursor.close()


def insert_project(conn, item: dict) -> int | None:
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM projects WHERE slug = %s", (item['slug'],))
        row = cursor.fetchone()
        if row:
            return row[0]

        cursor.execute("""
            INSERT INTO projects (user_id, title, slug, description, cover_image,
                                  dominant_color, status, views_count, likes_count,
                                  comments_count, created_at, updated_at)
            VALUES (%s, %s, %s, %s, %s, %s, 'published', %s, %s, %s, NOW(), NOW())
        """, (
            item['user_id'], item['title'], item['slug'], item['description'],
            item['cover_image'], item.get('dominant_color'),
            item['views_count'], item['likes_count'], item['comments_count']
        ))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"   ⚠ DB error insert_project: {e}")
        conn.rollback()
        return None
    finally:
        cursor.close()


def insert_project_images(conn, project_id: int, images: list):
    cursor = conn.cursor()
    for i, img_url in enumerate(images):
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_images (project_id, image_path, sort_order, created_at, updated_at)
                VALUES (%s, %s, %s, NOW(), NOW())
            """, (project_id, img_url, i))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def insert_project_categories(conn, project_id: int, category_ids: list):
    cursor = conn.cursor()
    for cat_id in category_ids:
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_categories (project_id, category_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (project_id, cat_id))
            cursor.execute("""
                UPDATE categories SET projects_count = projects_count + 1 WHERE id = %s
            """, (cat_id,))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def insert_project_tools(conn, project_id: int, tool_ids: list):
    cursor = conn.cursor()
    for tool_id in tool_ids:
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_tools (project_id, tool_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (project_id, tool_id))
        except Exception:
            continue
    conn.commit()
    cursor.close()


# =========================
# GENERATE DUMMY
# =========================
def generate_dummy(conn):
    cursor = conn.cursor()

    cursor.execute("SELECT id FROM users")
    user_ids = [r[0] for r in cursor.fetchall()]

    cursor.execute("SELECT id FROM projects")
    project_ids = [r[0] for r in cursor.fetchall()]

    if not user_ids or not project_ids:
        print("⚠ Tidak ada user/project untuk generate dummy")
        cursor.close()
        return

    print(f"\n🎲 Generate dummy data...")
    print(f"   Users: {len(user_ids)}, Projects: {len(project_ids)}")

    # ── LIKES ─────────────────────────────────────────────────
    likes_added = 0
    for _ in range(min(len(user_ids) * 5, 3000)):
        uid = random.choice(user_ids)
        pid = random.choice(project_ids)
        try:
            cursor.execute("""
                INSERT IGNORE INTO likes (project_id, user_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (pid, uid))
            if cursor.rowcount:
                likes_added += 1
        except Exception:
            continue
    conn.commit()
    print(f"   ❤  Likes: {likes_added}")

    # ── FOLLOWS ───────────────────────────────────────────────
    follows_added = 0
    for _ in range(min(len(user_ids) * 3, 2000)):
        follower  = random.choice(user_ids)
        following = random.choice(user_ids)
        if follower == following:
            continue
        try:
            cursor.execute("""
                INSERT IGNORE INTO follows (follower_id, following_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (follower, following))
            if cursor.rowcount:
                follows_added += 1
                cursor.execute("UPDATE users SET following_count = following_count + 1 WHERE id = %s", (follower,))
                cursor.execute("UPDATE users SET followers_count = followers_count + 1 WHERE id = %s", (following,))
        except Exception:
            continue
    conn.commit()
    print(f"   👥 Follows: {follows_added}")

    # ── BOOKMARKS ─────────────────────────────────────────────
    bookmarks_added = 0
    collections = ['Saved', 'Inspiration', 'Favorites', 'References', 'Mood Board']
    for _ in range(min(len(user_ids) * 3, 2000)):
        uid = random.choice(user_ids)
        pid = random.choice(project_ids)
        try:
            cursor.execute("""
                INSERT IGNORE INTO bookmarks (user_id, project_id, collection_name, created_at, updated_at)
                VALUES (%s, %s, %s, NOW(), NOW())
            """, (uid, pid, random.choice(collections)))
            if cursor.rowcount:
                bookmarks_added += 1
        except Exception:
            continue
    conn.commit()
    print(f"   🔖 Bookmarks: {bookmarks_added}")

    cursor.close()


# =========================
# UTIL
# =========================
def jeda(min_=None, max_=None):
    time.sleep(random.uniform(min_ or DELAY_MIN, max_ or DELAY_MAX))


def parse_number(text: str) -> int:
    try:
        text = text.replace(",", "").strip().lower()
        if "k" in text:
            return int(float(text.replace("k", "")) * 1_000)
        if "m" in text:
            return int(float(text.replace("m", "")) * 1_000_000)
        nums = re.findall(r"\d+", text)
        return int(nums[0]) if nums else 0
    except Exception:
        return 0


def make_slug(title: str) -> str:
    safe = re.sub(r"[^a-zA-Z0-9\s]", "", title)
    base = safe.strip().lower().replace(" ", "-")
    base = re.sub(r"-{2,}", "-", base)[:60]
    uid  = uuid.uuid4().hex[:8]
    return f"{base}-{uid}" if base else f"project-{uid}"


# =========================
# DRIVER
# =========================
def buat_driver(headless: bool = False):
    options = webdriver.ChromeOptions()
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    options.add_experimental_option("useAutomationExtension", False)
    options.add_argument("--no-sandbox")
    options.add_argument("--disable-dev-shm-usage")
    options.add_argument("--disable-gpu")
    options.add_argument("--no-proxy-server")
    options.add_argument("--disable-extensions")
    options.add_argument("--disable-software-rasterizer")
    options.add_argument("--ignore-certificate-errors")
    options.add_argument("--allow-running-insecure-content")
    options.add_argument("--disable-web-security")
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/147.0.0.0 Safari/537.36"
    )
    options.add_argument("--start-maximized")
    if headless:
        options.add_argument("--headless=new")
        options.add_argument("--window-size=1920,1080")

    if USE_WDM:
        try:
            driver = webdriver.Chrome(
                service=Service(ChromeDriverManager().install()),
                options=options
            )
        except Exception as e:
            print(f"⚠ webdriver_manager gagal: {e}")
            driver = webdriver.Chrome(options=options)
    else:
        driver = webdriver.Chrome(options=options)

    driver.execute_script(
        "Object.defineProperty(navigator, 'webdriver', {get: () => undefined})"
    )
    driver.set_page_load_timeout(30)
    driver.implicitly_wait(5)
    return driver


# =========================
# LOGIN
# =========================
def login(driver):
    for attempt in range(MAX_RETRY):
        try:
            driver.get("https://www.behance.net/")
            break
        except WebDriverException as e:
            print(f"⚠ Gagal buka Behance (attempt {attempt+1}): {e}")
            if attempt == MAX_RETRY - 1:
                raise
            time.sleep(3)

    print("\n" + "="*50)
    print("Silakan LOGIN di browser yang terbuka.")
    print("Setelah berhasil login, tekan ENTER di sini.")
    print("="*50)
    input()
    print("Login diterima. Memulai scraping...\n")


# =========================
# KUMPUL URL PROJECT
# =========================
def get_urls(driver, target: int = TARGET) -> tuple:
    urls     = set()
    url_meta = {}

    for query, cat_hint in SEARCH_QUERIES:
        if len(urls) >= target:
            break

        search_url = f"https://www.behance.net/search/projects?search={query.replace(' ', '+')}"
        print(f"\n🔍 Searching: '{query}'")

        loaded = False
        for attempt in range(MAX_RETRY):
            try:
                driver.get(search_url)
                time.sleep(4)
                loaded = True
                break
            except WebDriverException as e:
                print(f"   ⚠ Gagal load (attempt {attempt+1}): {e}")
                time.sleep(3)

        if not loaded:
            continue

        for scroll_i in range(SCROLL_ROUNDS):
            driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
            time.sleep(2.5)

            cards = driver.find_elements(By.CSS_SELECTOR, "a[href*='/gallery/']")
            for c in cards:
                try:
                    href = c.get_attribute("href")
                    if href and "/gallery/" in href:
                        clean = href.split("?")[0].split("#")[0]
                        if clean not in urls:
                            urls.add(clean)
                            url_meta[clean] = cat_hint
                except StaleElementReferenceException:
                    continue

            print(f"   Scroll {scroll_i+1}/{SCROLL_ROUNDS} → Total URL: {len(urls)}")
            if len(urls) >= target:
                break

    result = list(urls)[:target]
    print(f"\n✅ Total URL terkumpul: {len(result)}")
    return result, url_meta


# =========================
# HELPER
# =========================
def safe_text(driver, selectors: list, attr: str = None) -> str:
    for sel in selectors:
        try:
            el  = driver.find_element(By.CSS_SELECTOR, sel)
            val = el.get_attribute(attr) if attr else el.text.strip()
            if val:
                return val
        except Exception:
            continue
    return ""


def safe_stat(driver, selectors: list) -> int:
    text = safe_text(driver, selectors)
    return parse_number(text) if text else 0


# =========================
# SCRAPE OWNER
# =========================
def scrape_owner(driver) -> tuple:
    try:
        scripts = driver.find_elements(By.CSS_SELECTOR, "script:not([src])")
        for script in scripts:
            try:
                content = script.get_attribute("innerHTML") or ""
                if '"owners"' not in content:
                    continue
                m = re.search(
                    r'"owners"\s*:\s*\[\s*\{[^]]*?"displayName"\s*:\s*"([^"]+)"[^]]*?"url"\s*:\s*"([^"]+)"',
                    content, re.S
                )
                if not m:
                    m = re.search(
                        r'"owners"\s*:\s*\[\s*\{[^]]*?"url"\s*:\s*"([^"]+)"[^]]*?"displayName"\s*:\s*"([^"]+)"',
                        content, re.S
                    )
                    if m:
                        url_raw = m.group(1).replace("\\/", "/")
                        name    = m.group(2).strip()
                        um = re.search(r"behance\.net/([^/?#\s\"]+)", url_raw)
                        if um:
                            username = um.group(1).lower()
                            skip = {'search','jobs','gallery','collections','login',
                                    'signup','assets','projects','feeds','following'}
                            if username not in skip:
                                return name, username
                else:
                    name    = m.group(1).strip()
                    url_raw = m.group(2).replace("\\/", "/")
                    um = re.search(r"behance\.net/([^/?#\s\"]+)", url_raw)
                    if um:
                        username = um.group(1).lower()
                        skip = {'search','jobs','gallery','collections','login',
                                'signup','assets','projects','feeds','following'}
                        if username not in skip:
                            return name, username
            except Exception:
                continue
    except Exception as e:
        print(f"   ⚠ scrape_owner error: {e}")
    return "Unknown", f"user-{uuid.uuid4().hex[:5]}"


# =========================
# SCRAPE IMAGES
# =========================
def scrape_images(driver) -> list:
    images = []
    try:
        imgs = driver.find_elements(By.CSS_SELECTOR,
            "img[src*='mir-s3-cdn-cf.behance.net'], img[src*='behance.net/publishing']")
        seen = set()
        for img in imgs:
            src = img.get_attribute("src") or ""
            if src and src not in seen and "profile" not in src and "avatar" not in src:
                seen.add(src)
                images.append(src)
    except Exception:
        pass
    return images[:10]


# =========================
# SCRAPE DOMINANT COLOR
# =========================
def scrape_dominant_color(driver) -> str | None:
    """Ambil dominant color dari meta atau inline style."""
    try:
        # Cari di inline script JSON
        scripts = driver.find_elements(By.CSS_SELECTOR, "script:not([src])")
        for script in scripts:
            content = script.get_attribute("innerHTML") or ""
            m = re.search(r'"dominantColor"\s*:\s*"(#[0-9a-fA-F]{6})"', content)
            if m:
                return m.group(1)
            m = re.search(r'"background_color"\s*:\s*"(#[0-9a-fA-F]{6})"', content)
            if m:
                return m.group(1)
    except Exception:
        pass
    return None


# =========================
# SCRAPE CATEGORIES
# =========================
def scrape_categories(driver, cat_map: dict, query_hint: str) -> list:
    cat_ids = set()
    try:
        tags = driver.find_elements(By.CSS_SELECTOR,
            "a[href*='/search/projects?field='], "
            "[class*='ProjectInfo-fields'] a, "
            "[class*='fields'] a[href*='field']"
        )
        for tag in tags:
            text = tag.text.strip().lower()
            for cat_name, cat_id in cat_map.items():
                if cat_name in text or text in cat_name:
                    cat_ids.add(cat_id)

        if not cat_ids and query_hint:
            hint_lower = query_hint.lower()
            for cat_name, cat_id in cat_map.items():
                if cat_name in hint_lower or hint_lower in cat_name:
                    cat_ids.add(cat_id)
                    break

        if not cat_ids and "graphic design" in cat_map:
            cat_ids.add(cat_map["graphic design"])
    except Exception:
        pass
    return list(cat_ids)


# =========================
# SCRAPE TOOLS
# =========================
def scrape_tools(driver, tool_map: dict) -> list:
    """Ambil tools yang dipakai dari halaman project."""
    tool_ids = set()
    try:
        # Cari di inline script JSON
        scripts = driver.find_elements(By.CSS_SELECTOR, "script:not([src])")
        for script in scripts:
            content = script.get_attribute("innerHTML") or ""
            if '"tools"' not in content and '"software"' not in content:
                continue
            # Cari nama tool yang match
            for tool_name, tool_id in tool_map.items():
                if tool_name in content.lower():
                    tool_ids.add(tool_id)

        # Cari di elemen HTML
        if not tool_ids:
            tool_els = driver.find_elements(By.CSS_SELECTOR,
                "[class*='tool'] span, [class*='Tool'] span, "
                "a[href*='tools'], [class*='software']"
            )
            for el in tool_els:
                text = el.text.strip().lower()
                for tool_name, tool_id in tool_map.items():
                    if tool_name in text or text in tool_name:
                        tool_ids.add(tool_id)

        # Fallback: assign random 1-3 tools
        if not tool_ids:
            sample = random.sample(list(tool_map.values()), min(3, len(tool_map)))
            tool_ids.update(sample)

    except Exception:
        pass
    return list(tool_ids)


# =========================
# SCRAPE SATU PROJECT
# =========================
def scrape(driver, url: str, conn, cat_map: dict, tool_map: dict, query_hint: str) -> dict | None:
    for attempt in range(MAX_RETRY):
        try:
            driver.get(url)
            try:
                WebDriverWait(driver, 12).until(
                    EC.presence_of_element_located((By.TAG_NAME, "h1"))
                )
            except TimeoutException:
                print("   ⚠ Timeout tunggu h1")
            time.sleep(2)

            # ── OWNER ──────────────────────────────────────────────
            owner_name, owner_username = scrape_owner(driver)
            user_id = get_or_create_user(conn, owner_username, owner_name)
            print(f"   👤 {owner_name} (@{owner_username}) → user_id={user_id}")

            # ── TITLE ──────────────────────────────────────────────
            title = safe_text(driver, [
                "h1", "[class*='projectName']", "[class*='project-name']",
            ]) or "Untitled"
            title = re.sub(r"\s+", " ", title).strip()

            # ── DESCRIPTION ────────────────────────────────────────
            description = safe_text(driver, [
                "[class*='project-description']",
                "[class*='ProjectInfo-projectDescription']",
                "[class*='description']",
            ])
            if not description:
                description = safe_text(driver, [
                    "meta[name='description']",
                    "meta[property='og:description']",
                ], attr="content")

            # ── COVER IMAGE ────────────────────────────────────────
            cover_image = safe_text(driver, [
                "meta[property='og:image']",
                "meta[name='twitter:image']",
            ], attr="content")
            if not cover_image:
                try:
                    img = driver.find_element(By.CSS_SELECTOR,
                        "img[src*='mir-s3-cdn-cf.behance.net']")
                    cover_image = img.get_attribute("src") or ""
                except NoSuchElementException:
                    cover_image = ""

            # ── DOMINANT COLOR ─────────────────────────────────────
            dominant_color = scrape_dominant_color(driver)

            # ── STATS ──────────────────────────────────────────────
            views_count = safe_stat(driver, [
                "[class*='stats-views'] span", "[class*='ProjectStats-views']",
                "span[class*='view']",
            ])
            likes_count = safe_stat(driver, [
                "[class*='stats-appreciations'] span",
                "[class*='ProjectStats-appreciations']",
                "[class*='appreciation']",
            ])
            comments_count = safe_stat(driver, [
                "[class*='stats-comments'] span",
                "[class*='ProjectStats-comments']",
                "span[class*='Comment'] span",
            ])

            if views_count == 0 or likes_count == 0 or comments_count == 0:
                body = driver.find_element(By.TAG_NAME, "body").text
                if views_count == 0:
                    m = re.search(r"([\d.,]+[km]?)\s*views", body, re.I)
                    views_count = parse_number(m.group(1)) if m else 0
                if likes_count == 0:
                    m = re.search(r"([\d.,]+[km]?)\s*(appreciation|likes?)", body, re.I)
                    likes_count = parse_number(m.group(1)) if m else 0
                if comments_count == 0:
                    m = re.search(r"([\d.,]+[km]?)\s*comments?", body, re.I)
                    comments_count = parse_number(m.group(1)) if m else 0

            # ── IMAGES ─────────────────────────────────────────────
            images = scrape_images(driver)

            # ── CATEGORIES ─────────────────────────────────────────
            cat_ids = scrape_categories(driver, cat_map, query_hint)

            # ── TOOLS ──────────────────────────────────────────────
            tool_ids = scrape_tools(driver, tool_map)

            # ── INSERT KE DB ───────────────────────────────────────
            item = {
                "user_id":        user_id,
                "owner_name":     owner_name,
                "owner_username": owner_username,
                "title":          title,
                "slug":           make_slug(title),
                "description":    description,
                "cover_image":    cover_image,
                "dominant_color": dominant_color,
                "status":         "published",
                "views_count":    views_count,
                "likes_count":    likes_count,
                "comments_count": comments_count,
                "images":         images,
                "category_ids":   cat_ids,
                "tool_ids":       tool_ids,
                "_source_url":    url,
            }

            project_id = insert_project(conn, item)
            if project_id:
                if images:
                    insert_project_images(conn, project_id, images)
                if cat_ids:
                    insert_project_categories(conn, project_id, cat_ids)
                if tool_ids:
                    insert_project_tools(conn, project_id, tool_ids)
                item["_project_id"] = project_id

            return item

        except WebDriverException as e:
            print(f"   ⚠ WebDriverException attempt {attempt+1}/{MAX_RETRY}: {e}")
            if attempt < MAX_RETRY - 1:
                time.sleep(4)
            else:
                return None
        except Exception as e:
            print(f"   ❌ Error: {e}")
            return None


# =========================
# SAVE
# =========================
def _save(data: list, path: str):
    with open(path, "w", encoding="utf-8") as f:
        json.dump(data, f, indent=2, ensure_ascii=False)


# =========================
# MAIN
# =========================
def main():
    print("="*50)
    print("  BEHANCE SCRAPER LENGKAP — Starting")
    print("="*50)

    try:
        conn = get_db()
        print("✅ Database connected!")
    except Exception as e:
        print(f"❌ Gagal koneksi database: {e}")
        return

    cat_map  = setup_categories(conn)
    tool_map = setup_tools(conn)

    driver = buat_driver(headless=False)

    try:
        login(driver)

        urls, url_meta = get_urls(driver, TARGET)
        print(f"\nMulai scraping {len(urls)} project...\n")

        if os.path.exists(OUTPUT_FILE):
            try:
                with open(OUTPUT_FILE, "r", encoding="utf-8") as f:
                    data = json.load(f)
                print(f"📂 Load data lama: {len(data)} item")
            except (json.JSONDecodeError, ValueError):
                data = []
        else:
            data = []

        done_urls = {item.get("_source_url", "") for item in data}
        urls = [u for u in urls if u not in done_urls]
        print(f"⏭  Skip {len(done_urls)} URL yang sudah ada")
        print(f"▶  Sisa yang akan di-scrape: {len(urls)} URL\n")

        failed     = []
        start_time = time.time()

        for i, url in enumerate(urls, 1):
            print(f"[{i:>3}/{len(urls)}] {url[:80]}")

            query_hint = url_meta.get(url, "Graphic Design")
            item = scrape(driver, url, conn, cat_map, tool_map, query_hint)

            if item:
                data.append(item)
                print(f"   ✔ {item['title'][:40]} | "
                      f"🖼{len(item['images'])} | "
                      f"🏷{len(item['category_ids'])} | "
                      f"🔧{len(item['tool_ids'])} | "
                      f"👁{item['views_count']} ❤{item['likes_count']}")
            else:
                failed.append(url)

            if i % 10 == 0:
                _save(data, OUTPUT_FILE)
                elapsed = time.time() - start_time
                print(f"   💾 Auto-saved {len(data)} item ({elapsed:.0f}s)")

            jeda()

            if len(data) >= TARGET:
                print("\n🎯 Target tercapai!")
                break

    finally:
        _save(data, OUTPUT_FILE)

        print("\n" + "="*50)
        print(f"✅ Scraping selesai: {len(data)} project")
        print("="*50)

        generate_dummy(conn)
        conn.close()

        if failed:
            with open("failed_urls.txt", "w") as f:
                f.write("\n".join(failed))
            print(f"   URL gagal → failed_urls.txt")

        driver.quit()
        print("\n✅ SEMUA SELESAI!")


if __name__ == "__main__":
    main()