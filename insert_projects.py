import mysql.connector
import json

with open("behance_data.json", "r", encoding="utf-8") as f:
    data = json.load(f)

conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="behance_sbd"
)
cursor = conn.cursor()

sql = """
    INSERT IGNORE INTO projects 
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

print(f"✅ {cursor.rowcount} data berhasil dimasukkan ke tabel projects.")

cursor.close()
conn.close()