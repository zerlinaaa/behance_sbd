<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Buat VIEW trending_projects
     *
     * VIEW ini menggabungkan:
     * - projects (data utama)
     * - users    (info creator)
     * - project_categories + categories (nama kategori)
     * - likes    (hitung live)
     * - bookmarks (hitung live)
     *
     * Tinggal SELECT * FROM trending_projects — tidak perlu
     * tulis ulang JOIN yang panjang setiap kali.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW trending_projects AS

            SELECT
                p.id                                                        AS project_id,
                p.title,
                p.slug,
                p.cover_image,
                p.description,
                p.status,
                p.likes_count,
                p.views_count,
                p.comments_count,
                p.created_at                                                AS published_at,

                /* ── Info creator ── */
                u.id                                                        AS user_id,
                u.name                                                      AS creator_name,
                u.username                                                  AS creator_username,
                u.avatar                                                    AS creator_avatar,

                /* ── Kategori (digabung jadi satu string) ── */
                GROUP_CONCAT(
                    DISTINCT c.name
                    ORDER BY c.name
                    SEPARATOR ', '
                )                                                           AS categories,

                /* ── Hitung LIVE dari tabel asli ── */
                COUNT(DISTINCT l.id)                                        AS like_count_live,
                COUNT(DISTINCT b.id)                                        AS bookmark_count,

                /* ── Trending score (formula sederhana) ── */
                (
                    p.likes_count
                    + (p.views_count   / 100)
                    + (p.comments_count * 2)
                )                                                           AS trending_score

            FROM  projects            p
            JOIN  users               u   ON  u.id = p.user_id

            LEFT JOIN project_categories pc ON  pc.project_id = p.id
            LEFT JOIN categories         c  ON  c.id  = pc.category_id
            LEFT JOIN likes              l  ON  l.project_id  = p.id
            LEFT JOIN bookmarks          b  ON  b.project_id  = p.id

            WHERE  p.status = 'published'
              AND  p.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)

            GROUP BY
                p.id,
                p.title,
                p.slug,
                p.cover_image,
                p.description,
                p.status,
                p.likes_count,
                p.views_count,
                p.comments_count,
                p.created_at,
                u.id,
                u.name,
                u.username,
                u.avatar

            ORDER BY trending_score DESC
        ");
    }

    /**
     * Hapus VIEW saat rollback migration
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS trending_projects');
    }
};