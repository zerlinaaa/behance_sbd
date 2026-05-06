import mysql.connector
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
import re
import time

# ── Koneksi MySQL ────────────────────────────────────────────────
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="behance_sbd"
)
cursor = conn.cursor()

# ── Scraping kategori dari Behance ───────────────────────────────
driver = webdriver.Chrome()
driver.get("https://www.behance.net/search/projects")

time.sleep(3)

soup = BeautifulSoup(driver.page_source, "html.parser")

# Ambil kategori dari filter Behance
categories = []
seen_slugs = set()

category_elements = soup.find_all("a", href=re.compile(r"/search/projects\?field="))

for el in category_elements:
    name = el.get_text(strip=True)
    href = el.get("href", "")
    slug = href.split("field=")[-1].split("&")[0].lower().replace("%20", "-").replace(" ", "-")

    if name and slug and slug not in seen_slugs:
        seen_slugs.add(slug)
        categories.append((name, slug))

driver.quit()

# ── Insert ke MySQL ──────────────────────────────────────────────
sql = """
    INSERT IGNORE INTO categories (name, slug, is_active, created_at, updated_at)
    VALUES (%s, %s, 1, NOW(), NOW())
"""

cursor.executemany(sql, categories)
conn.commit()

print(f"✅ {cursor.rowcount} kategori berhasil dimasukkan.")

cursor.close()
conn.close()