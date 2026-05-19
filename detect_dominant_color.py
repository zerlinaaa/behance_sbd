import math, time, requests, pymysql
from io import BytesIO
from PIL import Image
from colorthief import ColorThief

DB_HOST = '127.0.0.1'
DB_PORT = 3306
DB_NAME = 'behance_sbd'
DB_USER = 'root'
DB_PASS = ''

DELAY = 0.3

COLOR_PALETTE = {
    'red':    (231, 76,  60),
    'orange': (230, 126, 34),
    'yellow': (241, 196, 15),
    'green':  (46,  204, 113),
    'blue':   (52,  152, 219),
    'purple': (155, 89,  182),
    'pink':   (233, 30,  140),
    'black':  (17,  17,  17),
    'white':  (245, 245, 245),
    'teal':   (26,  188, 156),
}

def color_distance(c1, c2):
    return math.sqrt(sum((a - b) ** 2 for a, b in zip(c1, c2)))

def map_to_named_color(rgb):
    return min(COLOR_PALETTE, key=lambda name: color_distance(rgb, COLOR_PALETTE[name]))

def get_dominant_color(image_url):
    try:
        resp = requests.get(image_url, timeout=10, headers={'User-Agent': 'Mozilla/5.0'})
        resp.raise_for_status()
        img = Image.open(BytesIO(resp.content)).convert('RGB')
        img.thumbnail((200, 200))
        buf = BytesIO()
        img.save(buf, format='PNG')
        buf.seek(0)
        rgb = ColorThief(buf).get_color(quality=5)
        return rgb, map_to_named_color(rgb)
    except:
        return None, None

def main():
    conn = pymysql.connect(host=DB_HOST, port=DB_PORT, db=DB_NAME, user=DB_USER, passwd=DB_PASS, charset='utf8mb4')
    cursor = conn.cursor()
    cursor.execute("SELECT id, cover_image FROM projects WHERE (color IS NULL OR color = '') AND cover_image IS NOT NULL AND status = 'published'")
    projects = cursor.fetchall()
    total = len(projects)
    updated = failed = 0
    print(f"🎨 Total project: {total}")
    for i, (pid, url) in enumerate(projects, 1):
        rgb, named = get_dominant_color(url)
        if named:
            cursor.execute("UPDATE projects SET color = %s WHERE id = %s", (named, pid))
            conn.commit()
            updated += 1
            print(f"[{i}/{total}] ✅ ID {pid} → {named} {rgb}")
        else:
            failed += 1
            print(f"[{i}/{total}] ❌ ID {pid} → gagal")
        time.sleep(DELAY)
    cursor.close()
    conn.close()
    print(f"\n✅ Updated: {updated} | ❌ Gagal: {failed}")

if __name__ == '__main__':
    main()