<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW creator_stats AS

            SELECT
                u.id                                    AS user_id,
                u.name,
                u.username,
                u.avatar,
                u.bio,
                u.location,
                u.created_at                            AS joined_at,

                /* ── Follower info ── */
                u.followers_count,
                u.following_count,

                /* ── Statistik project ── */
                COUNT(DISTINCT p.id)                    AS total_projects,
                COALESCE(SUM(p.likes_count),    0)      AS total_likes,
                COALESCE(SUM(p.views_count),    0)      AS total_views,
                COALESCE(AVG(p.likes_count),    0)      AS avg_likes_per_project,
                COALESCE(MAX(p.likes_count),    0)      AS best_project_likes,
                COALESCE(MAX(p.views_count),    0)      AS best_project_views,

                /* ── Interaksi yang diterima ── */
                COUNT(DISTINCT cm.id)                   AS total_comments_received,
                COUNT(DISTINCT bm.id)                   AS total_bookmarks_received,

                /* ── Aktivitas terakhir ── */
                MAX(p.created_at)                       AS last_posted_at,

                /* ── Engagement rate sederhana ── */
                CASE
                    WHEN COALESCE(SUM(p.views_count), 0) = 0 THEN 0
                    ELSE ROUND(
                        (COALESCE(SUM(p.likes_count), 0) /
                         COALESCE(SUM(p.views_count), 1)) * 100,
                        2
                    )
                END                                     AS engagement_rate

            FROM  users u

            LEFT JOIN projects   p  ON  p.user_id    = u.id
                                    AND p.status      = 'published'

            LEFT JOIN comments   cm ON  cm.project_id = p.id
                                    AND cm.is_approved = 1

            LEFT JOIN bookmarks  bm ON  bm.project_id = p.id

            WHERE u.role = 'user'

            GROUP BY
                u.id,
                u.name,
                u.username,
                u.avatar,
                u.bio,
                u.location,
                u.created_at,
                u.followers_count,
                u.following_count
        ");
        // ORDER BY dihapus dari VIEW — lakukan saat query: SELECT * FROM creator_stats ORDER BY total_likes DESC
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS creator_stats');
    }
};