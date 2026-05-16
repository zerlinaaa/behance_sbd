<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'projects');
        $sort = $request->get('sort', 'trending');

        // ══════════════════════════════════════════
        // SHARED: Kategori untuk pill nav + sidebar
        // ══════════════════════════════════════════
        $categories = DB::table('categories as c')
            ->leftJoin('project_categories as pc', 'pc.category_id', '=', 'c.id')
            ->selectRaw('c.id, c.name, c.slug, c.icon, COUNT(pc.id) AS project_count')
            ->where('c.is_active', 1)
            ->groupBy('c.id', 'c.name', 'c.slug', 'c.icon')
            ->orderByDesc('project_count')
            ->get();

        // Data filter sidebar
        $locations = DB::table('users')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->limit(30)
            ->pluck('location');

        $availabilityOptions = [
            'available'     => 'Available for Work',
            'freelance'     => 'Freelance',
            'fulltime'      => 'Full-time',
            'not_available' => 'Not Available',
        ];

        $toolOptions = [
            'Figma', 'Adobe XD', 'Photoshop', 'Illustrator',
            'Blender', 'After Effects', 'Sketch', 'Procreate',
            'Cinema 4D', 'InDesign', 'Lightroom', 'Premiere Pro',
        ];

        $colorOptions = [
            'red'    => '#e74c3c', 'orange' => '#e67e22',
            'yellow' => '#f1c40f', 'green'  => '#2ecc71',
            'blue'   => '#3498db', 'purple' => '#9b59b6',
            'pink'   => '#e91e8c', 'brown'  => '#795548',
            'black'  => '#111111', 'white'  => '#f5f5f5',
            'gray'   => '#95a5a6', 'teal'   => '#1abc9c',
        ];

        // ══════════════════════════════════════════
        // PEOPLE
        // ══════════════════════════════════════════
        $people = collect();

        if ($type === 'people') {
            $peopleQuery = DB::table('users')
                ->where('role', 'user')
                ->where('name', '!=', 'Unknown');

            if ($keyword = $request->get('q')) {
                $peopleQuery->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('username', 'like', "%{$keyword}%")
                      ->orWhere('location', 'like', "%{$keyword}%");
                });
            }

            if ($availabilities = $request->get('availability')) {
                $peopleQuery->whereIn('availability', (array) $availabilities);
            }

            if ($locations_filter = $request->get('location')) {
                $peopleQuery->where(function ($q) use ($locations_filter) {
                    foreach ((array) $locations_filter as $loc) {
                        $q->orWhere('location', 'like', "%{$loc}%");
                    }
                });
            }

            $people = $peopleQuery
                ->orderByDesc('followers_count')
                ->get();
        }

        // ══════════════════════════════════════════
        // PROJECTS / ASSETS / IMAGES
        // assets & images ditampilkan sama seperti projects
        // karena kolom `type` tidak ada di tabel projects
        // ══════════════════════════════════════════
        $query = DB::table('projects as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('project_categories as pc', 'pc.project_id', '=', 'p.id')
            ->leftJoin('categories as c', 'c.id', '=', 'pc.category_id')
            ->selectRaw('DISTINCT
                p.id, p.title, p.slug, p.cover_image,
                p.likes_count, p.views_count, p.comments_count,
                p.created_at,
                u.id AS user_id, u.name AS creator_name,
                u.username AS creator_username, u.avatar AS creator_avatar
            ')
            ->where('p.status', 'published');

        // Filter: keyword
        if ($keyword = $request->get('q')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('p.title', 'like', "%{$keyword}%")
                  ->orWhere('p.description', 'like', "%{$keyword}%")
                  ->orWhere('u.name', 'like', "%{$keyword}%");
            });
        }

        // Filter: category pill
        if ($categorySlug = $request->get('category')) {
            $query->where('c.slug', $categorySlug);
        }

        // Filter: creative fields (sidebar)
        if ($fields = $request->get('fields')) {
            $query->whereIn('c.slug', (array) $fields);
        }

        // Filter: Tools (JSON search)
        if ($tools = $request->get('tools')) {
        $query->where(function ($q) use ($tools) {
        foreach ((array) $tools as $tool) {
            $q->orWhereRaw("JSON_SEARCH(p.tools, 'one', ?) IS NOT NULL", [$tool]);
        }
     });
    }   
        // Filter: Color
        if ($color = $request->get('color')) {
        $query->where('p.color', $color);
        }

        // Sort
        match ($sort) {
            'newest'     => $query->orderByDesc('p.created_at'),
            'popular'    => $query->orderByDesc('p.views_count'),
            'most_liked' => $query->orderByDesc('p.likes_count'),
            default      => $query->orderByDesc('p.likes_count')->orderByDesc('p.views_count'),
        };

        $feedProjects = $query->paginate(24)->withQueryString();

        // ── AJAX: infinite scroll
        if ($request->ajax() || $request->wantsJson()) {
            if ($type === 'people') {
                return response()->json(['projects' => [], 'has_more' => false]);
            }
            return response()->json([
                'projects' => $feedProjects->items(),
                'has_more' => $feedProjects->hasMorePages(),
            ]);
        }

        return view('dashboard', compact(
            'feedProjects', 'categories', 'people', 'type', 'sort',
            'locations', 'availabilityOptions', 'toolOptions', 'colorOptions'
        ));
    }
}