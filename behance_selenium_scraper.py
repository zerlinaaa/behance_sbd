"""
============================================================
BEHANCE SCRAPER — Laravel Ready (500–700 data)
============================================================
Fix:
- buat_driver() ditambah flag anti-blokir jaringan
- Hapus --headless (sering bikin ERR_ADDRESS_UNREACHABLE)
- Tambah --disable-web-security & proxy bypass
- Tambah retry otomatis kalau page gagal load
- WebDriverWait lebih toleran
============================================================
"""

import json, time, random, re, os
from datetime import datetime
import uuid

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
OUTPUT_FILE = "behance_data.json"
DELAY_MIN   = 2.5
DELAY_MAX   = 4.5
SCROLL_ROUNDS = 12
MAX_RETRY   = 3   # retry per URL kalau gagal load


# =========================
# UTIL
# =========================
def jeda(min_=None, max_=None):
    time.sleep(random.uniform(min_ or DELAY_MIN, max_ or DELAY_MAX))


def parse_number(text: str) -> int:
    """Ubah '1.2k', '3M', '4,500' → integer."""
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
    """Buat slug unik dari title."""
    safe  = re.sub(r"[^a-zA-Z0-9\s]", "", title)
    base  = safe.strip().lower().replace(" ", "-")
    base  = re.sub(r"-{2,}", "-", base)[:60]
    uid   = uuid.uuid4().hex[:8]
    return f"{base}-{uid}" if base else f"project-{uid}"


# =========================
# DRIVER — PERBAIKAN UTAMA
# =========================
def buat_driver(headless: bool = False):
    options = webdriver.ChromeOptions()

    # ── Anti-deteksi ──────────────────────────────────────
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    options.add_experimental_option("useAutomationExtension", False)

    # ── Fix jaringan (utama penyebab ERR_ADDRESS_UNREACHABLE) ──
    options.add_argument("--no-sandbox")
    options.add_argument("--disable-dev-shm-usage")
    options.add_argument("--disable-gpu")
    options.add_argument("--no-proxy-server")              # bypass proxy sistem
    options.add_argument("--disable-extensions")
    options.add_argument("--disable-software-rasterizer")
    options.add_argument("--ignore-certificate-errors")
    options.add_argument("--allow-running-insecure-content")
    options.add_argument("--disable-web-security")

    # ── User-Agent biar kelihatan browser biasa ───────────
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/147.0.0.0 Safari/537.36"
    )

    options.add_argument("--start-maximized")

    # Headless DINONAKTIFKAN secara default — penyebab utama error jaringan
    # Aktifkan hanya jika sudah dipastikan jaringan OK
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
            print("  Mencoba pakai chromedriver dari PATH...")
            driver = webdriver.Chrome(options=options)
    else:
        driver = webdriver.Chrome(options=options)

    # Sembunyikan webdriver flag
    driver.execute_script(
        "Object.defineProperty(navigator, 'webdriver', {get: () => undefined})"
    )

    # Set timeout koneksi
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
    print("Setelah berhasil login, kembali ke sini dan tekan ENTER.")
    print("="*50)
    input()
    print("Login diterima. Memulai scraping...\n")


# =========================
# KUMPUL URL PROJECT
# =========================
def get_urls(driver, target: int = TARGET) -> list:
    urls = set()

    search_queries = [
        "design",
        "branding",
        "ui ux",
        "illustration",
        "typography",
        "photography",
        "motion graphics",
    ]

    for query in search_queries:
        if len(urls) >= target:
            break

        search_url = f"https://www.behance.net/search/projects?search={query.replace(' ', '+')}"
        print(f"\n🔍 Searching: '{query}'")

        # Retry load halaman search
        loaded = False
        for attempt in range(MAX_RETRY):
            try:
                driver.get(search_url)
                time.sleep(4)
                loaded = True
                break
            except WebDriverException as e:
                print(f"   ⚠ Gagal load search page (attempt {attempt+1}): {e}")
                time.sleep(3)

        if not loaded:
            print(f"   ❌ Skip query '{query}' — halaman tidak bisa diload")
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
                        urls.add(clean)
                except StaleElementReferenceException:
                    continue

            print(f"   Scroll {scroll_i+1}/{SCROLL_ROUNDS} → Total URL: {len(urls)}")

            if len(urls) >= target:
                break

    result = list(urls)[:target]
    print(f"\n✅ Total URL terkumpul: {len(result)}")
    return result


# =========================
# HELPER: AMBIL TEKS AMAN
# =========================
def safe_text(driver, selectors: list, attr: str = None) -> str:
    for sel in selectors:
        try:
            el = driver.find_element(By.CSS_SELECTOR, sel)
            val = el.get_attribute(attr) if attr else el.text.strip()
            if val:
                return val
        except (NoSuchElementException, Exception):
            continue
    return ""


def safe_stat(driver, selectors: list) -> int:
    text = safe_text(driver, selectors)
    return parse_number(text) if text else 0


# =========================
# SCRAPE SATU PROJECT (+ RETRY)
# =========================
def scrape(driver, url: str) -> dict | None:
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

            # ── TITLE ──────────────────────────────────────────────
            title = safe_text(driver, [
                "h1",
                "h1.ProjectInfo-projectName-YC8",
                "[class*='projectName']",
                "[class*='project-name']",
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
                        "img[src*='mir-s3-cdn-cf.behance.net'], img[src*='behance.net']")
                    cover_image = img.get_attribute("src") or ""
                except NoSuchElementException:
                    cover_image = ""

            # ── STATS ──────────────────────────────────────────────
            views_count = safe_stat(driver, [
                "[class*='stats-views'] span",
                "[class*='ProjectStats-views']",
                "[data-testid='views-count']",
                "span[class*='Views'] span",
                "span[class*='view']",
            ])

            likes_count = safe_stat(driver, [
                "[class*='stats-appreciations'] span",
                "[class*='ProjectStats-appreciations']",
                "[data-testid='appreciations-count']",
                "span[class*='Appreciate'] span",
                "[class*='appreciation']",
            ])

            comments_count = safe_stat(driver, [
                "[class*='stats-comments'] span",
                "[class*='ProjectStats-comments']",
                "[data-testid='comments-count']",
                "span[class*='Comment'] span",
                "[class*='comment-count']",
            ])

            # Fallback regex dari body text
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

            return {
                "user_id":        1,
                "title":          title,
                "description":    description,
                "cover_image":    cover_image,
                "slug":           make_slug(title),
                "status":         "published",
                "views_count":    views_count,
                "likes_count":    likes_count,
                "comments_count": comments_count,
            }

        except WebDriverException as e:
            print(f"   ⚠ WebDriverException attempt {attempt+1}/{MAX_RETRY}: {e}")
            if attempt < MAX_RETRY - 1:
                time.sleep(4)
            else:
                print(f"   ❌ Gagal setelah {MAX_RETRY} percobaan: {url}")
                return None

        except Exception as e:
            print(f"   ❌ Error scraping {url}: {e}")
            return None


# =========================
# MAIN
# =========================
def main():
    print("="*50)
    print("  BEHANCE SCRAPER — Starting")
    print("="*50)

    driver = buat_driver(headless=False)  # Jangan headless dulu!

    try:
        login(driver)

        urls = get_urls(driver, TARGET)
        print(f"\nMulai scraping {len(urls)} project...\n")

        data       = []
        failed     = []
        start_time = time.time()

        for i, url in enumerate(urls, 1):
            print(f"[{i:>3}/{len(urls)}] {url[:80]}")

            item = scrape(driver, url)

            if item:
                data.append(item)
                print(f"   ✔ {item['title'][:50]} | 👁{item['views_count']} ❤{item['likes_count']} 💬{item['comments_count']}")
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

        print("\n" + "="*50)
        print(f"✅ SELESAI")
        print(f"   Berhasil : {len(data)}")
        print(f"   Gagal    : {len(failed)}")
        print(f"   Output   : {OUTPUT_FILE}")
        print("="*50)

        if failed:
            with open("failed_urls.txt", "w") as f:
                f.write("\n".join(failed))
            print(f"   URL gagal disimpan di failed_urls.txt")

        driver.quit()


def _save(data: list, path: str):
    with open(path, "w", encoding="utf-8") as f:
        json.dump(data, f, indent=2, ensure_ascii=False)


if __name__ == "__main__":
    main()