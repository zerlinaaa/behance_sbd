import mysql.connector

conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="behance_sbd"
)
cursor = conn.cursor()

cursor.execute("SELECT id, title, slug FROM projects")
projects = cursor.fetchall()

# ── Step 1: Insert semua user dulu ──────────────────────────────
for i, (project_id, title, slug) in enumerate(projects, start=2):
    username = slug[:30].replace("-", "_").lower()
    name = f"Creator {i}"
    email = f"creator{i}@behance.com"

    cursor.execute("""
        INSERT IGNORE INTO users (id, name, username, email, password, role, created_at, updated_at)
        VALUES (%s, %s, %s, %s, 'password', 'user', NOW(), NOW())
    """, (i, name, username, email))

conn.commit()
print("✅ Semua user berhasil diinsert!")

# ── Step 2: Update project pakai user_id baru ───────────────────
for i, (project_id, title, slug) in enumerate(projects, start=2):
    cursor.execute("UPDATE projects SET user_id = %s WHERE id = %s", (i, project_id))

conn.commit()
print(f"✅ {len(projects)} project berhasil diupdate user_id-nya!")

cursor.close()
conn.close()