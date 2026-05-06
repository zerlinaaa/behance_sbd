<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Project, Category};

class ExploreController extends Controller
{
    /**
     * Halaman galeri utama — mirip halaman explore Behance
     * Route: GET /explore
     */
    public function index(Request $request)
    {
        // ════════════════════════════════════════════════════
        // ① JOIN 3 TABEL — dasar semua query di halaman ini
        //    projects + users + project_categories + categories
        //    Pakai DISTINCT karena satu project bisa masuk
        //    banyak kategori (duplikat baris tanpa DISTINCT)
        // ════════════════════════════════════════════════════
        $query = DB::table('projects as p')
            ->join('users as u',
                    'u.id', '=', 'p.user_id')
            ->leftJoin('project_categories as pc',
                        'pc.project_id', '=', 'p.id')
            ->leftJoin('categories as c',
                        'c.id', '=', 'pc.category_id')
            ->selectRaw('
                DISTINCT
                p.id,
                p.title,
                p.slug,
                p.cover_image,
                p.likes_count,
                p.views_count,
                p.comments_count,
                p.created_at,
                u.id       AS user_id,
                u.name     AS creator_name,
                u.username AS creator_username,
                u.avatar   AS creator_avatar
            ')
            ->where('p.status', 'published');

        // ════════════════════════════════════════════════════
        // ② FILTER — Keyword search (WHERE LIKE)
        //    Mencari di title, description, dan nama creator
        // ════════════════════════════════════════════════════
        if ($keyword = $request->get('q')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('p.title',       'like', "%{$keyword}%")
                  ->orWhere('p.description', 'like', "%{$keyword}%")
                  ->orWhere('u.name',        'like', "%{$keyword}%")
                  ->orWhere('u.username',    'like', "%{$keyword}%");
            });
        }

        // ════════════════════════════════════════════════════
        // ③ FILTER — By kategori slug
        // ════════════════════════════════════════════════════
        if ($categorySlug = $request->get('category')) {
            $query->where('c.slug', $categorySlug);
        }

        // ════════════════════════════════════════════════════
        // ④ SORT — Pilihan urutan tampil
        // ════════════════════════════════════════════════════
        match ($request->get('sort', 'trending')) {
            'newest'  => $query->orderByDesc('p.created_at'),
            'popular' => $query->orderByDesc('p.views_count'),
            'most_liked' => $query->orderByDesc('p.likes_count'),
            default   => $query->orderByDesc('p.likes_count')
                                ->orderByDesc('p.views_count'),
        };

        // ════════════════════════════════════════════════════
        // ⑤ SUBQUERY EXISTS — hanya project yang punya gambar
        //    Penting: project tanpa gambar tidak ditampilkan
        // ════════════════════════════════════════════════════
        // $query->whereExists(function ($sub) {
        //    $sub->select(DB::raw(1))
        //         ->from('project_images')
        //         ->whereColumn('project_images.project_id', 'p.id');
        // });

        // ════════════════════════════════════════════════════
        // ⑥ Jalankan query dengan pagination (24 per halaman)
        // ════════════════════════════════════════════════════
        $projects = $query->paginate(24)->withQueryString();

        // ════════════════════════════════════════════════════
        // ⑦ Kategori untuk sidebar filter + hitungan project
        // ════════════════════════════════════════════════════
        $categories = DB::table('categories as c')
            ->leftJoin('project_categories as pc',
                        'pc.category_id', '=', 'c.id')
            ->selectRaw('c.id, c.name, c.slug, c.icon,
                         COUNT(pc.id) AS project_count')
            ->where('c.is_active', 1)
            ->groupBy('c.id', 'c.name', 'c.slug', 'c.icon')
            ->orderByDesc('project_count')
            ->get();

        return view('explore', compact(
            'projects',
            'categories'
        ));
    }

    /**
     * Halaman detail project
     * Route: GET /projects/{slug}
     */
    public function show(string $slug)
    {
        // JOIN 4 tabel: project + user + categories + images
        $project = DB::table('projects as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->selectRaw('
                p.*,
                u.name     AS creator_name,
                u.username AS creator_username,
                u.avatar   AS creator_avatar,
                u.bio      AS creator_bio,
                u.followers_count
            ')
            ->where('p.slug', $slug)
            ->firstOrFail();

        // Gambar project (diurutkan sort_order)
        $images = DB::table('project_images')
            ->where('project_id', $project->id)
            ->orderBy('sort_order')
            ->get();

        // Komentar dengan nama user (JOIN)
        $comments = DB::table('comments as cm')
            ->join('users as u', 'u.id', '=', 'cm.user_id')
            ->select('cm.*', 'u.name', 'u.avatar', 'u.username')
            ->where('cm.project_id', $project->id)
            ->whereNull('cm.parent_id')     // hanya komentar root
            ->where('cm.is_approved', 1)
            ->orderByDesc('cm.created_at')
            ->get();

        // Tambah view count
        DB::table('projects')
            ->where('id', $project->id)
            ->increment('views_count');

        // Project lain dari creator yang sama (related projects)
        $related = DB::table('projects')
            ->where('user_id', $project->user_id)
            ->where('id', '!=', $project->id)
            ->where('status', 'published')
            ->orderByDesc('likes_count')
            ->limit(4)
            ->get();

        return view('projects.show', compact(
            'project', 'images', 'comments', 'related'
        ));
    }
}