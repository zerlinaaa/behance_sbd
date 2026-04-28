<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ─── TRIGGER: likes ───────────────────────────────────────
        DB::unprepared('
            CREATE TRIGGER trg_likes_after_insert
            AFTER INSERT ON likes FOR EACH ROW
            BEGIN
                UPDATE projects
                SET    likes_count = likes_count + 1
                WHERE  id = NEW.project_id;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER trg_likes_after_delete
            AFTER DELETE ON likes FOR EACH ROW
            BEGIN
                UPDATE projects
                SET    likes_count = GREATEST(likes_count - 1, 0)
                WHERE  id = OLD.project_id;
            END
        ');

        // ─── TRIGGER: comments ────────────────────────────────────
        DB::unprepared('
            CREATE TRIGGER trg_comments_after_insert
            AFTER INSERT ON comments FOR EACH ROW
            BEGIN
                UPDATE projects
                SET    comments_count = comments_count + 1
                WHERE  id = NEW.project_id;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER trg_comments_after_delete
            AFTER DELETE ON comments FOR EACH ROW
            BEGIN
                UPDATE projects
                SET    comments_count = GREATEST(comments_count - 1, 0)
                WHERE  id = OLD.project_id;
            END
        ');

        // ─── TRIGGER: follows ─────────────────────────────────────
        DB::unprepared('
            CREATE TRIGGER trg_follows_after_insert
            AFTER INSERT ON follows FOR EACH ROW
            BEGIN
                UPDATE users SET followers_count = followers_count + 1
                WHERE  id = NEW.following_id;
                UPDATE users SET following_count = following_count + 1
                WHERE  id = NEW.follower_id;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER trg_follows_after_delete
            AFTER DELETE ON follows FOR EACH ROW
            BEGIN
                UPDATE users
                SET    followers_count = GREATEST(followers_count - 1, 0)
                WHERE  id = OLD.following_id;
                UPDATE users
                SET    following_count = GREATEST(following_count - 1, 0)
                WHERE  id = OLD.follower_id;
            END
        ');

        // ─── STORED PROCEDURE: GetTrendingProjects ────────────────
        DB::unprepared('
            CREATE PROCEDURE GetTrendingProjects(
                IN p_limit INT,
                IN p_days  INT
            )
            BEGIN
                IF p_limit IS NULL OR p_limit <= 0 THEN SET p_limit = 10; END IF;
                IF p_days  IS NULL OR p_days  <= 0 THEN SET p_days  = 30; END IF;
                SELECT
                    p.id, p.title, p.slug, p.cover_image,
                    p.likes_count, p.views_count, p.comments_count,
                    p.created_at,
                    u.name     AS creator_name,
                    u.username AS creator_username,
                    u.avatar   AS creator_avatar,
                    GROUP_CONCAT(DISTINCT c.name ORDER BY c.name SEPARATOR ", ") AS categories,
                    (p.likes_count + (p.views_count/100) + (p.comments_count*2)) AS trending_score
                FROM  projects p
                JOIN  users    u   ON u.id = p.user_id
                LEFT JOIN project_categories pc ON pc.project_id = p.id
                LEFT JOIN categories         c  ON c.id = pc.category_id
                WHERE  p.status = "published"
                  AND  p.created_at >= DATE_SUB(NOW(), INTERVAL p_days DAY)
                GROUP BY
                    p.id, p.title, p.slug, p.cover_image,
                    p.likes_count, p.views_count, p.comments_count,
                    p.created_at, u.name, u.username, u.avatar
                ORDER BY trending_score DESC
                LIMIT  p_limit;
            END
        ');

        // ─── STORED PROCEDURE: ToggleLike ─────────────────────────
        DB::unprepared('
            CREATE PROCEDURE ToggleLike(
                IN  p_user_id    BIGINT,
                IN  p_project_id BIGINT,
                OUT p_action     VARCHAR(10)
            )
            BEGIN
                DECLARE v_exists INT DEFAULT 0;
                SELECT COUNT(*) INTO v_exists
                FROM  likes
                WHERE user_id = p_user_id AND project_id = p_project_id;
                IF v_exists > 0 THEN
                    DELETE FROM likes
                    WHERE user_id = p_user_id AND project_id = p_project_id;
                    SET p_action = "unliked";
                ELSE
                    INSERT INTO likes (user_id, project_id, created_at, updated_at)
                    VALUES (p_user_id, p_project_id, NOW(), NOW());
                    SET p_action = "liked";
                END IF;
            END
        ');

        // ─── FUNCTION: CalculateTrendingScore ─────────────────────
        DB::unprepared('
            CREATE FUNCTION CalculateTrendingScore(
                p_likes    INT,
                p_views    INT,
                p_comments INT
            ) RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                RETURN (p_likes + (p_views/100) + (p_comments*2));
            END
        ');

        // ─── INDEX ─────────────────────────────────────────────────
        DB::statement('CREATE INDEX idx_projects_status_created ON projects(status, created_at DESC)');
        DB::statement('CREATE INDEX idx_projects_likes_count   ON projects(likes_count DESC)');
        DB::statement('CREATE INDEX idx_likes_created_at       ON likes(created_at)');
        DB::statement('CREATE INDEX idx_comments_project_id    ON comments(project_id)');
        DB::statement('CREATE INDEX idx_follows_following_id   ON follows(following_id)');
        DB::statement('CREATE INDEX idx_users_followers_count  ON users(followers_count DESC)');
    }

    public function down(): void
    {
        // Hapus semua dalam urutan terbalik
        DB::unprepared('DROP FUNCTION  IF EXISTS CalculateTrendingScore');
        DB::unprepared('DROP PROCEDURE IF EXISTS ToggleLike');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetTrendingProjects');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetCreatorStats');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_follows_after_delete');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_follows_after_insert');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_comments_after_delete');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_comments_after_insert');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_likes_after_delete');
        DB::unprepared('DROP TRIGGER  IF EXISTS trg_likes_after_insert');
    }
};