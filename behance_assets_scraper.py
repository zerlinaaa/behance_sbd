"""
============================================================
BEHANCE ASSETS SCRAPER — Laravel Ready
============================================================
Fix scrape_owner: ambil dari script[7] inline JSON
Key: "owners" → "displayName" + "url" (berisi username)
Output: behance_assets.json
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
TARGET      = 700
OUTPUT_FILE = "behance_assets.json"
DELAY_MIN   = 2.5
DELAY_MAX   = 4.5
SCROLL_ROUNDS = 12
MAX_RETRY   = 3

DB_CONFIG = {
    'host':     'localhost',
    'user':     'root',
    'password': '',
    'database': 'behance_sbd'
}

ASSET_TYPE_MAP = {
    "font":         "font",
    "typeface":     "font",
    "typography":   "font",
    "template":     "template",
    "mockup":       "mockup",
    "icon":         "icon",
    "icons":        "icon",
    "illustration": "illustration",
}

SEARCH_QUERIES = [
    ("font",         "font"),
    ("typeface",     "font"),
    ("mockup",       "mockup"),
    ("ui template",  "template"),
    ("icon set",     "icon"),
    ("illustration", "illustration"),
    ("branding kit", "other"),
    ("logo template","template"),
]


# =========================
# DATABASE
# =========================
def get_db():
    return mysql.connector.connect(**DB_CONFIG)


def get_or_create_user(conn, username: str, name: str) -> int:
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM users WHERE username = %s", (username,))
        row = cursor.fetchone()
        if row:
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
    return f"{base}-{uid}" if base else f"asset-{uid}"


def guess_asset_type(title: str, description: str, keyword_hint: str = "") -> str:
    text = (title + " " + description + " " + keyword_hint).lower()
    for kw, atype in ASSET_TYPE_MAP.items():
        if kw in text:
            return atype
    return "other"


def parse_price(text: str):
    if not text:
        return "free", None, "USD"
    if "free" in text.lower():
        return "free", None, "USD"
    m = re.search(r"([A-Z]{2,3})?\s*\$?\s*([\d.,]+)", text, re.I)
    if m:
        price = float(m.group(2).replace(",", ""))
        return "premium", price, "USD"
    return "free", None, "USD"


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
# LOGIN MANUAL
# =========================
def login(driver):
    for attempt in range(MAX_RETRY):
        try:
            driver.get("https://www.behance.net/")
            break
        except WebDriverException as e:
            print(f"⚠ Gagal buka Behance (attempt {attempt+1}/{MAX_RETRY}): {e}")
            if attempt == MAX_RETRY - 1:
                raise
            time.sleep(3)

    print("\n" + "="*50)
    print("Silakan LOGIN di browser yang terbuka.")
    print("Setelah berhasil login, tekan ENTER di sini.")
    print("="*50)
    input()
    print("Login diterima. Mulai scraping assets...\n")


# =========================
# KUMPUL URL ASSETS
# =========================
def get_asset_urls(driver, target: int = TARGET) -> tuple:
    urls     = set()
    url_meta = {}

    for query, type_hint in SEARCH_QUERIES:
        if len(urls) >= target:
            break

        search_url = f"https://www.behance.net/search/assets?search={query.replace(' ', '+')}"
        print(f"\n🔍 Searching assets: '{query}' (type hint: {type_hint})")

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
            print(f"   ❌ Skip '{query}'")
            continue

        for scroll_i in range(SCROLL_ROUNDS):
            driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
            time.sleep(2.5)

            cards = driver.find_elements(By.CSS_SELECTOR,
                "a[href*='/gallery/'], a[href*='/projects/']")
            for c in cards:
                try:
                    href = c.get_attribute("href")
                    if href and ("/gallery/" in href or "/projects/" in href):
                        clean = href.split("?")[0].split("#")[0]
                        if clean not in urls:
                            urls.add(clean)
                            url_meta[clean] = {
                                "keyword_hint": query,
                                "asset_type_hint": type_hint
                            }
                except StaleElementReferenceException:
                    continue

            print(f"   Scroll {scroll_i+1}/{SCROLL_ROUNDS} → Total URL: {len(urls)}")
            if len(urls) >= target:
                break

    result = list(urls)[:target]
    print(f"\n✅ Total asset URL terkumpul: {len(result)}")
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
# SCRAPE OWNER — INLINE SCRIPT JSON (FIX FINAL)
# =========================
def scrape_owner(driver) -> tuple:
    """
    Behance embed data project di inline script tag sebagai JSON.
    owners[0].displayName = nama pemilik
    owners[0].url = https://www.behance.net/username
    """
    try:
        scripts = driver.find_elements(By.CSS_SELECTOR, "script:not([src])")
        for script in scripts:
            try:
                content = script.get_attribute("innerHTML") or ""
                if '"owners"' not in content:
                    continue

                # Cari pattern owners array dengan displayName dan url
                m = re.search(
                    r'"owners"\s*:\s*\[\s*\{[^]]*?"displayName"\s*:\s*"([^"]+)"[^]]*?"url"\s*:\s*"([^"]+)"',
                    content, re.S
                )
                if not m:
                    # Coba urutan terbalik url dulu baru displayName
                    m = re.search(
                        r'"owners"\s*:\s*\[\s*\{[^]]*?"url"\s*:\s*"([^"]+)"[^]]*?"displayName"\s*:\s*"([^"]+)"',
                        content, re.S
                    )
                    if m:
                        url_raw  = m.group(1).replace("\\/", "/")
                        name     = m.group(2).strip()
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
# SCRAPE SATU ASSET
# =========================
def scrape_asset(driver, url: str, meta: dict, conn) -> dict | None:
    keyword_hint = meta.get("keyword_hint", "")
    type_hint    = meta.get("asset_type_hint", "other")

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
                "h1",
                "[class*='projectName']",
                "[class*='project-name']",
            ]) or "Untitled Asset"
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
                        "img[src*='mir-s3-cdn-cf.behance.net'], img[src*='behance.net']")
                    cover_image = img.get_attribute("src") or ""
                except NoSuchElementException:
                    cover_image = ""

            # ── HARGA ──────────────────────────────────────────────
            price_text = safe_text(driver, [
                "[class*='price']",
                "[class*='Price']",
                "[data-testid='asset-price']",
                "span[class*='cost']",
            ])
            if not price_text:
                body = driver.find_element(By.TAG_NAME, "body").text
                m = re.search(r"(US\s*\$[\d.,]+|FREE|free|\$[\d.,]+)", body)
                price_text = m.group(1) if m else ""

            license_type, price_val, currency = parse_price(price_text)

            # ── ASSET TYPE ─────────────────────────────────────────
            asset_type = guess_asset_type(title, description or "", keyword_hint)
            if asset_type == "other" and type_hint != "other":
                asset_type = type_hint

            # ── STATS ──────────────────────────────────────────────
            views_count = safe_stat(driver, [
                "[class*='stats-views'] span",
                "[class*='ProjectStats-views']",
                "span[class*='view']",
            ])
            likes_count = safe_stat(driver, [
                "[class*='stats-appreciations'] span",
                "[class*='ProjectStats-appreciations']",
                "[class*='appreciation']",
            ])

            if views_count == 0 or likes_count == 0:
                body = driver.find_element(By.TAG_NAME, "body").text
                if views_count == 0:
                    m = re.search(r"([\d.,]+[km]?)\s*views", body, re.I)
                    views_count = parse_number(m.group(1)) if m else 0
                if likes_count == 0:
                    m = re.search(r"([\d.,]+[km]?)\s*(appreciation|likes?)", body, re.I)
                    likes_count = parse_number(m.group(1)) if m else 0

            return {
                "user_id":        user_id,
                "owner_name":     owner_name,
                "owner_username": owner_username,
                "title":          title,
                "slug":           make_slug(title),
                "description":    description,
                "cover_image":    cover_image,
                "asset_type":     asset_type,
                "license":        license_type,
                "price":          price_val,
                "currency":       currency,
                "status":         "published",
                "views_count":    views_count,
                "likes_count":    likes_count,
                "_category_hint": keyword_hint,
                "_source_url":    url,
            }

        except WebDriverException as e:
            print(f"   ⚠ WebDriverException attempt {attempt+1}/{MAX_RETRY}: {e}")
            if attempt < MAX_RETRY - 1:
                time.sleep(4)
            else:
                print(f"   ❌ Gagal: {url}")
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
    print("  BEHANCE ASSETS SCRAPER — Starting")
    print("  Output → behance_assets.json")
    print("="*50)

    try:
        conn = get_db()
        print("✅ Database connected!")
    except Exception as e:
        print(f"❌ Gagal koneksi database: {e}")
        return

    driver = buat_driver(headless=False)

    try:
        login(driver)

        urls, url_meta = get_asset_urls(driver, TARGET)
        print(f"\nMulai scraping {len(urls)} asset...\n")

        if os.path.exists(OUTPUT_FILE):
            try:
                with open(OUTPUT_FILE, "r", encoding="utf-8") as f:
                    data = json.load(f)
                print(f"📂 Load data lama: {len(data)} item")
            except (json.JSONDecodeError, ValueError):
                print("⚠ File JSON lama kosong/corrupt, mulai dari awal")
                data = []
        else:
            data = []

        done_urls = {item["_source_url"] for item in data}
        urls = [u for u in urls if u not in done_urls]
        print(f"⏭  Skip {len(done_urls)} URL yang sudah ada")
        print(f"▶  Sisa yang akan di-scrape: {len(urls)} URL\n")

        failed     = []
        start_time = time.time()

        for i, url in enumerate(urls, 1):
            print(f"[{i:>3}/{len(urls)}] {url[:80]}")

            meta = url_meta.get(url, {"keyword_hint": "", "asset_type_hint": "other"})
            item = scrape_asset(driver, url, meta, conn)

            if item:
                data.append(item)
                price_str = f"${item['price']}" if item['price'] else "FREE"
                print(f"   ✔ [{item['asset_type']}] {item['title'][:40]} | "
                      f"{price_str} | 👁{item['views_count']} ❤{item['likes_count']}")
            else:
                failed.append(url)

            if i % 10 == 0:
                _save(data, OUTPUT_FILE)
                elapsed = time.time() - start_time
                print(f"   💾 Auto-saved {len(data)} item ({elapsed:.0f}s elapsed)")

            jeda()

            if len(data) >= TARGET:
                print("\n🎯 Target tercapai!")
                break

    finally:
        _save(data, OUTPUT_FILE)
        conn.close()

        print("\n" + "="*50)
        print(f"✅ SELESAI")
        print(f"   Berhasil : {len(data)}")
        print(f"   Gagal    : {len(failed)}")
        print(f"   Output   : {OUTPUT_FILE}")
        print("="*50)

        if failed:
            with open("failed_asset_urls.txt", "w") as f:
                f.write("\n".join(failed))
            print(f"   URL gagal → failed_asset_urls.txt")

        driver.quit()


if __name__ == "__main__":
    main() 