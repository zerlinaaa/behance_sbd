import mysql.connector
import json

with open("behance_data.json", "r", encoding="utf-8") as f:
    data = json.load(f)

conn = mysql.connector.connect(
    host="localhost",
    user="root",          # ganti sesuai MySQL kamu
    password="",  # ganti sesuai MySQL kamu
    database="behance_sbd"
)
cursor = conn.cursor()

cursor.execute("""
    CREATE TABLE IF NOT EXISTS behance_projects (
        id             INT AUTO_INCREMENT PRIMARY KEY,
        user_id        INT,
        title          VARCHAR(500),
        description    TEXT,
        cover_image    VARCHAR(1000),
        slug           VARCHAR(500) UNIQUE,
        status         VARCHAR(50),
        views_count    INT DEFAULT 0,
        likes_count    INT DEFAULT 0,
        comments_count INT DEFAULT 0
    )
""")
conn.commit()


sql = """
    INSERT IGNORE INTO behance_projects 
        (user_id, title, description, cover_image, slug, status, views_count, likes_count, comments_count)
    VALUES 
        (%s, %s, %s, %s, %s, %s, %s, %s, %s)
"""

rows = [
    (
        item["user_id"],
        item["title"],
        item["description"],
        item["cover_image"],
        item["slug"],
        item["status"],
        item["views_count"],
        item["likes_count"],
        item["comments_count"]
    )
    for item in data
]

cursor.executemany(sql, rows)
conn.commit()

print(f"✅ {cursor.rowcount} data berhasil dimasukkan dari {len(data)} total.")

cursor.close()
conn.close()