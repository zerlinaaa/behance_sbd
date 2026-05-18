"""
============================================================
INSERT PROJECTS — Baca dari behance_data.json → DB
============================================================
Insert:
- users        (owner project)
- categories   (15 default)
- tools        (15 default)
- projects
- project_images
- project_categories
- project_tools
- likes, follows, bookmarks (dummy)
============================================================
"""

import json, re, random
import mysql.connector
import bcrypt

DB_CONFIG = {
    'host':     'localhost',
    'user':     'root',
    'password': '',
    'database': 'behance_sbd'
}

INPUT_FILE = "behance_data.json"

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
    "Adobe Photoshop", "Adobe Illustrator", "Adobe InDesign",
    "Adobe After Effects", "Adobe Photoshop Lightroom", "Adobe XD",
    "Adobe Premiere Pro", "Adobe Dimension", "Figma", "Sketch",
    "Cinema 4D", "Blender", "Procreate", "Canva", "CorelDRAW",
]


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
                cat_map[row[0]] = row[0]
            else:
                cursor.execute("""
                    INSERT INTO categories (name, slug, is_active, projects_count, created_at, updated_at)
                    VALUES (%s, %s, 1, 0, NOW(), NOW())
                """, (name, slug))
                conn.commit()
                cat_map[cursor.lastrowid] = cursor.lastrowid
        except Exception as e:
            print(f"⚠ Category error ({name}): {e}")
            conn.rollback()
    cursor.close()

    cursor = conn.cursor()
    cursor.execute("SELECT id FROM categories")
    all_ids = [r[0] for r in cursor.fetchall()]
    cursor.close()
    print(f"✅ Categories: {len(all_ids)}")
    return all_ids


def setup_tools(conn) -> list:
    cursor = conn.cursor()
    for name in DEFAULT_TOOLS:
        slug = re.sub(r"[^a-z0-9]+", "-", name.lower()).strip("-")
        try:
            cursor.execute("SELECT id FROM tools WHERE slug = %s", (slug,))
            row = cursor.fetchone()
            if not row:
                cursor.execute("""
                    INSERT INTO tools (name, slug, created_at, updated_at)
                    VALUES (%s, %s, NOW(), NOW())
                """, (name, slug))
                conn.commit()
        except Exception as e:
            print(f"⚠ Tool error ({name}): {e}")
            conn.rollback()

    cursor.execute("SELECT id FROM tools")
    all_ids = [r[0] for r in cursor.fetchall()]
    cursor.close()
    print(f"✅ Tools: {len(all_ids)}")
    return all_ids


def get_or_create_user(conn, username: str, name: str) -> int:
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM users WHERE username = %s", (username,))
        row = cursor.fetchone()
        if row:
            return row[0]
        hashed = bcrypt.hashpw(b"password123", bcrypt.gensalt()).decode()
        cursor.execute("""
            INSERT INTO users (name, username, email, password, role, followers_count, following_count, created_at, updated_at)
            VALUES (%s, %s, %s, %s, 'scraped', 0, 0, NOW(), NOW())
        """, (name or username, username, f"{username}@behance-scraped.com", hashed))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"⚠ User error ({username}): {e}")
        conn.rollback()
        return 1
    finally:
        cursor.close()


def insert_project(conn, item: dict, user_id: int) -> int | None:
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
            user_id, item['title'], item['slug'], item.get('description'),
            item.get('cover_image'), item.get('dominant_color'),
            item.get('views_count', 0), item.get('likes_count', 0),
            item.get('comments_count', 0)
        ))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"⚠ Project error ({item.get('title', '?')}): {e}")
        conn.rollback()
        return None
    finally:
        cursor.close()


def insert_images(conn, project_id: int, images: list):
    cursor = conn.cursor()
    for i, url in enumerate(images or []):
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_images (project_id, image_path, sort_order, created_at, updated_at)
                VALUES (%s, %s, %s, NOW(), NOW())
            """, (project_id, url, i))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def insert_project_categories(conn, project_id: int, cat_ids: list, all_cat_ids: list):
    cursor = conn.cursor()
    ids = cat_ids if cat_ids else random.sample(all_cat_ids, min(2, len(all_cat_ids)))
    for cat_id in ids:
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_categories (project_id, category_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (project_id, cat_id))
            cursor.execute("UPDATE categories SET projects_count = projects_count + 1 WHERE id = %s", (cat_id,))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def insert_project_tools(conn, project_id: int, tool_ids: list, all_tool_ids: list):
    cursor = conn.cursor()
    ids = tool_ids if tool_ids else random.sample(all_tool_ids, min(3, len(all_tool_ids)))
    for tool_id in ids:
        try:
            cursor.execute("""
                INSERT IGNORE INTO project_tools (project_id, tool_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (project_id, tool_id))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def generate_dummy(conn):
    cursor = conn.cursor()
    cursor.execute("SELECT id FROM users")
    user_ids = [r[0] for r in cursor.fetchall()]
    cursor.execute("SELECT id FROM projects")
    project_ids = [r[0] for r in cursor.fetchall()]
    cursor.close()

    if not user_ids or not project_ids:
        print("⚠ Tidak ada data untuk generate dummy")
        return

    print(f"\n🎲 Generate dummy (users={len(user_ids)}, projects={len(project_ids)})...")

    cursor = conn.cursor()

    # Likes
    likes = 0
    for _ in range(min(len(user_ids) * 5, 3000)):
        try:
            cursor.execute("""
                INSERT IGNORE INTO likes (project_id, user_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (random.choice(project_ids), random.choice(user_ids)))
            if cursor.rowcount:
                likes += 1
        except Exception:
            continue
    conn.commit()
    print(f"   ❤  Likes: {likes}")

    # Follows
    follows = 0
    for _ in range(min(len(user_ids) * 3, 2000)):
        f1, f2 = random.choice(user_ids), random.choice(user_ids)
        if f1 == f2:
            continue
        try:
            cursor.execute("""
                INSERT IGNORE INTO follows (follower_id, following_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (f1, f2))
            if cursor.rowcount:
                follows += 1
        except Exception:
            continue
    conn.commit()
    print(f"   👥 Follows: {follows}")

    # Bookmarks
    bookmarks = 0
    collections = ['Saved', 'Inspiration', 'Favorites', 'References', 'Mood Board']
    for _ in range(min(len(user_ids) * 3, 2000)):
        try:
            cursor.execute("""
                INSERT IGNORE INTO bookmarks (user_id, project_id, collection_name, created_at, updated_at)
                VALUES (%s, %s, %s, NOW(), NOW())
            """, (random.choice(user_ids), random.choice(project_ids), random.choice(collections)))
            if cursor.rowcount:
                bookmarks += 1
        except Exception:
            continue
    conn.commit()
    print(f"   🔖 Bookmarks: {bookmarks}")

    cursor.close()


def main():
    print("="*50)
    print("  INSERT PROJECTS — Starting")
    print("="*50)

    with open(INPUT_FILE, encoding='utf-8') as f:
        data = json.load(f)
    print(f"📂 Data: {len(data)} projects")

    conn = get_db()
    print("✅ Database connected!")

    all_cat_ids  = setup_categories(conn)
    all_tool_ids = setup_tools(conn)

    success = 0
    failed  = 0

    for i, item in enumerate(data, 1):
        try:
            username = item.get('owner_username', f"user-{i}")
            name     = item.get('owner_name', 'Unknown')
            user_id  = get_or_create_user(conn, username, name)

            project_id = insert_project(conn, item, user_id)
            if project_id:
                insert_images(conn, project_id, item.get('images', []))
                insert_project_categories(conn, project_id, item.get('category_ids', []), all_cat_ids)
                insert_project_tools(conn, project_id, item.get('tool_ids', []), all_tool_ids)
                success += 1
                if i % 50 == 0:
                    print(f"   [{i}/{len(data)}] ✔ {success} inserted")
            else:
                failed += 1
        except Exception as e:
            print(f"   ❌ Error item {i}: {e}")
            failed += 1

    print(f"\n✅ Projects inserted: {success}")
    print(f"❌ Failed: {failed}")

    generate_dummy(conn)
    conn.close()
    print("\n✅ SELESAI!")


if __name__ == "__main__":
    main()