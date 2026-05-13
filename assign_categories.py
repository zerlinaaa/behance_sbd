import mysql.connector
import json

# ── Koneksi database (sesuaikan dengan .env kamu) ──
conn = mysql.connector.connect(
    host="127.0.0.1",
    port=3306,
    user="root",        # ganti jika perlu
    password="",        # ganti jika perlu
    database="behance_sbd"
)
cursor = conn.cursor(dictionary=True)

# ── Ambil kategori dari database ──
cursor.execute("SELECT id, name, slug FROM categories")
categories = cursor.fetchall()
print("Kategori tersedia:", [c['name'] for c in categories])

# ── Mapping kata kunci → kategori ──
keyword_map = {
    "UI/UX Design":     ["ui", "ux", "ui/ux", "app", "mobile app", "dashboard", "interface", "figma", "webflow", "saas", "website", "web app"],
    "Web Design":       ["web design", "website", "landing page", "webpage", "webflow", "crypto trading website"],
    "Branding":         ["brand", "branding", "identity", "logo", "packaging", "brand identity", "brand design"],
    "Graphic Design":   ["graphic", "poster", "typography", "layout", "editorial", "magazine", "flyer", "visual"],
    "Illustration":     ["illustration", "character", "mascot", "drawing", "art", "cartoon", "comic"],
    "Photography":      ["photo", "photography", "photoshoot", "portrait", "lightroom"],
    "Motion Graphics":  ["motion", "animation", "after effects", "video", "gif", "3d animation", "motion graphics"],
    "3D Design":        ["3d", "blender", "cinema 4d", "rhinoceros", "keyshot", "cgi", "render", "modeling"],
    "Product Design":   ["product", "industrial design", "furniture", "gadget", "device", "razor", "watch", "car", "vehicle", "suv", "ev", "shuttle"],
    "Typography":       ["typography", "typeface", "font", "lettering", "calligraphy"],
}

# Buat dict slug → id
cat_slug_map = {c['name']: c['id'] for c in categories}

def get_category_id(title, description):
    text = (title + " " + (description or "")).lower()
    for cat_name, keywords in keyword_map.items():
        for kw in keywords:
            if kw in text:
                if cat_name in cat_slug_map:
                    return cat_slug_map[cat_name]
    # Default: Graphic Design
    return cat_slug_map.get("Graphic Design")

# ── Ambil project yang belum punya kategori ──
cursor.execute("""
    SELECT id, title, description FROM projects
    WHERE id NOT IN (SELECT project_id FROM project_categories)
""")
projects = cursor.fetchall()
print(f"Project tanpa kategori: {len(projects)}")

# ── Assign kategori ──
success = 0
for p in projects:
    cat_id = get_category_id(p['title'], p['description'])
    if cat_id:
        cursor.execute(
            "INSERT INTO project_categories (project_id, category_id) VALUES (%s, %s)",
            (p['id'], cat_id)
        )
        success += 1

conn.commit()
cursor.close()
conn.close()

print(f"✅ {success} project berhasil di-assign kategori!")