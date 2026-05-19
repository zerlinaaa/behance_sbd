"""
============================================================
INSERT ASSETS — Baca dari behance_assets.json → DB
============================================================
Insert:
- users          (owner asset, skip kalau sudah ada)
- assets         (termasuk owner_name, owner_username)
- asset_categories
============================================================
"""

import json, random
import mysql.connector
import bcrypt

DB_CONFIG = {
    'host':     'localhost',
    'user':     'root',
    'password': '',
    'database': 'behance_sbd'
}

INPUT_FILE = "behance_assets.json"


def get_db():
    return mysql.connector.connect(**DB_CONFIG)


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
            VALUES (%s, %s, %s, %s, 'user', 0, 0, NOW(), NOW())
        """, (name or username, username, f"{username}@behance-scraped.com", hashed))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"⚠ User error ({username}): {e}")
        conn.rollback()
        return 1
    finally:
        cursor.close()


def get_category_ids(conn) -> list:
    cursor = conn.cursor()
    cursor.execute("SELECT id FROM categories")
    ids = [r[0] for r in cursor.fetchall()]
    cursor.close()
    return ids


def insert_asset(conn, item: dict, user_id: int) -> int | None:
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM assets WHERE slug = %s", (item['slug'],))
        row = cursor.fetchone()
        if row:
            return row[0]

        cursor.execute("""
            INSERT INTO assets (user_id, title, slug, description, cover_image,
                                asset_type, license, price, currency, status,
                                owner_name, owner_username,
                                views_count, likes_count, created_at, updated_at)
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, 'published',
                    %s, %s, %s, %s, NOW(), NOW())
        """, (
            user_id,
            item['title'],
            item['slug'],
            item.get('description'),
            item.get('cover_image'),
            item.get('asset_type', 'other'),
            item.get('license', 'free'),
            item.get('price'),
            item.get('currency', 'USD'),
            item.get('owner_name', 'Unknown'),
            item.get('owner_username', ''),
            item.get('views_count', 0),
            item.get('likes_count', 0),
        ))
        conn.commit()
        return cursor.lastrowid
    except Exception as e:
        print(f"⚠ Asset error ({item.get('title', '?')}): {e}")
        conn.rollback()
        return None
    finally:
        cursor.close()


def insert_asset_categories(conn, asset_id: int, all_cat_ids: list):
    if not all_cat_ids:
        return
    cursor = conn.cursor()
    ids = random.sample(all_cat_ids, min(2, len(all_cat_ids)))
    for cat_id in ids:
        try:
            cursor.execute("""
                INSERT IGNORE INTO asset_categories (asset_id, category_id, created_at, updated_at)
                VALUES (%s, %s, NOW(), NOW())
            """, (asset_id, cat_id))
        except Exception:
            continue
    conn.commit()
    cursor.close()


def main():
    print("="*50)
    print("  INSERT ASSETS — Starting")
    print("="*50)

    with open(INPUT_FILE, encoding='utf-8') as f:
        data = json.load(f)
    print(f"📂 Data: {len(data)} assets")

    conn = get_db()
    print("✅ Database connected!")

    all_cat_ids = get_category_ids(conn)
    if not all_cat_ids:
        print("⚠ Tidak ada categories — jalankan insert_projects.py dulu!")
        conn.close()
        return

    print(f"✅ Categories tersedia: {len(all_cat_ids)}")

    success = 0
    failed  = 0

    for i, item in enumerate(data, 1):
        try:
            username = item.get('owner_username', f"user-{i}")
            name     = item.get('owner_name', 'Unknown')
            user_id  = get_or_create_user(conn, username, name)

            asset_id = insert_asset(conn, item, user_id)
            if asset_id:
                insert_asset_categories(conn, asset_id, all_cat_ids)
                success += 1
                if i % 50 == 0:
                    print(f"   [{i}/{len(data)}] ✔ {success} inserted")
            else:
                failed += 1
        except Exception as e:
            print(f"   ❌ Error item {i}: {e}")
            failed += 1

    conn.close()
    print(f"\n✅ Assets inserted: {success}")
    print(f"❌ Failed: {failed}")
    print("\n✅ SELESAI!")


if __name__ == "__main__":
    main()