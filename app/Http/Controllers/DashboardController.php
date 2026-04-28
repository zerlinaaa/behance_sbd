<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Project, User, Category};

class DashboardController extends Controller
{
    /**
     * Halaman dashboard admin — menampilkan semua statistik
     * Route: GET /dashboard
     */
    public function index()
    {
        // ════════════════════════════════════════════════════
        // ① JOIN 3 TABEL — Trending projects bulan ini
        //    Tabel: projects + users + categories
        // ════════════════════════════════════════════════════
        $trendingProjects = DB::table('projects as p')
            ->join('users as u',
                    'u.id', '=', 'p.user_id')
            ->join('project_categories as pc',
                    'pc.project_id', '=', 'p.id')
            ->join('categories as c',
                    'c.id', '=', 'pc.category_id')
            ->select([
                'p.id',
                'p.title',
                'p.cover_image',
                'p.likes_count',
                'p.views_count',
                'p.created_at',
                'u.name     as creator_name',
                'u.username as creator_username',
                'u.avatar   as creator_avatar',
                'c.name     as category_name',
            ])
            ->where('p.status', 'published')
            ->where('p.created_at', '>=', now()->subDays(30))
            ->orderByDesc('p.likes_count')
            ->limit(6)
            ->get();

        // ════════════════════════════════════════════════════
        // ② AGGREGATE GROUP BY — Likes per bulan (12 bulan)
        //    Dipakai untuk grafik Chart.js di Blade
        // ════════════════════════════════════════════════════
        $likesPerMonth = DB::table('likes')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') AS periode,
                DATE_FORMAT(created_at, '%b %Y') AS label,
                COUNT(*)                          AS total_likes
            ")
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->get();

        // ════════════════════════════════════════════════════
        // ③ AGGREGATE SUM + AVG — Statistik per kategori
        //    JOIN 3 tabel: categories + project_categories + projects
        // ════════════════════════════════════════════════════
        $categoryStats = DB::table('categories as c')
            ->join('project_categories as pc',
                    'pc.category_id', '=', 'c.id')
            ->join('projects as p',
                    'p.id', '=', 'pc.project_id')
            ->selectRaw('
                c.id,
                c.name              AS category_name,
                c.icon,
                COUNT(p.id)         AS total_projects,
                SUM(p.views_count)  AS total_views,
                SUM(p.likes_count)  AS total_likes,
                AVG(p.likes_count)  AS avg_likes
            ')
            ->where('p.status', 'published')
            ->groupBy('c.id', 'c.name', 'c.icon')
            ->orderByDesc('total_projects')
            ->get();

        // ════════════════════════════════════════════════════
        // ④ HAVING — Creator aktif (≥3 project & ≥50 total likes)
        //    HAVING dipakai karena filter pada hasil agregasi
        // ════════════════════════════════════════════════════
        $topCreators = DB::table('users as u')
            ->join('projects as p', 'p.user_id', '=', 'u.id')
            ->selectRaw('
                u.id,
                u.name,
                u.username,
                u.avatar,
                u.followers_count,
                COUNT(p.id)         AS total_projects,
                SUM(p.likes_count)  AS total_likes,
                SUM(p.views_count)  AS total_views,
                AVG(p.likes_count)  AS avg_likes
            ')
            ->where('p.status', 'published')
            ->groupBy('u.id', 'u.name', 'u.username',
                       'u.avatar', 'u.followers_count')
            ->havingRaw('COUNT(p.id) >= ?',     [3])
            ->havingRaw('SUM(p.likes_count) >= ?', [50])
            ->orderByDesc('total_likes')
            ->limit(5)
            ->get();

        // ════════════════════════════════════════════════════
        // ⑤ SUBQUERY — Project di atas rata-rata likes
        //    Subquery: SELECT AVG(likes_count) FROM projects
        // ════════════════════════════════════════════════════
        $avgSubquery = DB::table('projects')
            ->selectRaw('AVG(likes_count)');

        $hotProjects = DB::table('projects as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->select([
                'p.id', 'p.title', 'p.cover_image',
                'p.likes_count', 'p.views_count',
                'u.name as creator_name',
            ])
            ->where('p.status', 'published')
            ->whereRaw('p.likes_count > (?)', [$avgSubquery])
            ->orderByDesc('p.likes_count')
            ->limit(10)
            ->get();

        // ════════════════════════════════════════════════════
        // ⑥ VIEW — Baca dari VIEW trending_projects
        //    VIEW sudah dibuat lewat migration
        // ════════════════════════════════════════════════════
        $fromView = DB::table('trending_projects')
            ->limit(10)
            ->get();

        // ════════════════════════════════════════════════════
        // ⑦ Statistik ringkas — card summary di atas dashboard
        // ════════════════════════════════════════════════════
        $summary = [
            'total_projects'  => Project::where('status', 'published')->count(),
            'total_users'     => User::count(),
            'total_likes'     => DB::table('likes')->count(),
            'total_comments'  => DB::table('comments')->count(),
            'total_bookmarks' => DB::table('bookmarks')->count(),
        ];

        // Siapkan data chart dalam format JSON untuk Chart.js
        $chartLabels = $likesPerMonth->pluck('label');
        $chartData   = $likesPerMonth->pluck('total_likes');

        return view('dashboard', compact(
            'trendingProjects',
            'likesPerMonth',
            'categoryStats',
            'topCreators',
            'hotProjects',
            'fromView',
            'summary',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Statistik per user (untuk admin melihat detail creator)
     * Route: GET /dashboard/user/{id}
     */
    public function userStats(int $userId)
    {
        // JOIN 4 tabel untuk profil lengkap satu user
        $profile = DB::table('users as u')
            ->leftJoin('projects as p',
                        'p.user_id', '=', 'u.id')
            ->leftJoin('follows as f',
                        'f.following_id', '=', 'u.id')
            ->selectRaw('
                u.id, u.name, u.username, u.avatar,
                u.bio, u.location, u.created_at,
                COUNT(DISTINCT p.id)    AS total_projects,
                SUM(p.likes_count)      AS total_likes,
                COUNT(DISTINCT f.id)    AS follower_count
            ')
            ->where('u.id', $userId)
            ->groupBy('u.id', 'u.name', 'u.username',
                       'u.avatar', 'u.bio',
                       'u.location', 'u.created_at')
            ->first();

        return view('dashboard.user-stats', compact('profile'));
    }
}