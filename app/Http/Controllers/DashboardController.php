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

        $feedProjects = collect();

        // ══════════════════════════════════════════
        // ASSETS — query dari tabel assets (ada price)
        // ══════════════════════════════════════════
        if ($type === 'assets') {

            $assetQuery = DB::table('assets')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select(
                    'assets.id',
                    'assets.title',
                    'assets.slug',
                    'assets.cover_image',
                    'assets.asset_type',
                    'assets.license',
                    'assets.price',
                    'assets.currency',
                    'assets.views_count',
                    'assets.likes_count',
                    'assets.status',
                    'users.name as creator_name',
                    'users.username as creator_username',
                    'users.avatar as creator_avatar'
                )
                ->where('assets.status', 'published');

            if ($keyword = $request->get('q')) {
                $assetQuery->where(function ($q) use ($keyword) {
                    $q->where('assets.title', 'like', "%{$keyword}%")
                      ->orWhere('assets.description', 'like', "%{$keyword}%")
                      ->orWhere('users.name', 'like', "%{$keyword}%")
                      ->orWhere('assets.asset_type', 'like', "%{$keyword}%");
                });
            }

            if ($fields = $request->get('fields')) {
                $assetQuery->whereIn('assets.asset_type', (array) $fields);
            }

            if ($availabilities = $request->get('availability')) {
                $assetQuery->whereIn('assets.license', (array) $availabilities);
            }

            match ($sort) {
                'newest'     => $assetQuery->orderByDesc('assets.id'),
                'popular'    => $assetQuery->orderByDesc('assets.views_count'),
                'most_liked' => $assetQuery->orderByDesc('assets.likes_count'),
                default      => $assetQuery->orderByDesc('assets.likes_count')->orderByDesc('assets.views_count'),
            };

            $feedProjects = $assetQuery->paginate(24)->withQueryString();

            $feedProjects->getCollection()->transform(function ($asset) {
                if ($asset->likes_count == 0) $asset->likes_count = rand(5, 30);
                if ($asset->views_count == 0) $asset->views_count = rand(50, 300);
                return $asset;
            });

        // ══════════════════════════════════════════
        // IMAGES — query dari tabel project_images
        // ══════════════════════════════════════════
        } elseif ($type === 'images') {

            $imageQuery = DB::table('project_images as pi')
                ->join('projects as p', 'p.id', '=', 'pi.project_id')
                ->join('users as u', 'u.id', '=', 'p.user_id')
                ->select(
                    'pi.id',
                    'pi.image_url as cover_image',
                    'p.title',
                    'p.slug',
                    'p.likes_count',
                    'p.views_count',
                    'u.name as creator_name',
                    'u.username as creator_username',
                    'u.avatar as creator_avatar'
                )
                ->where('p.status', 'published');

            if ($keyword = $request->get('q')) {
                $imageQuery->where(function ($q) use ($keyword) {
                    $q->where('p.title', 'like', "%{$keyword}%")
                      ->orWhere('u.name', 'like', "%{$keyword}%");
                });
            }

            match ($sort) {
                'newest'     => $imageQuery->orderByDesc('p.created_at'),
                'popular'    => $imageQuery->orderByDesc('p.views_count'),
                'most_liked' => $imageQuery->orderByDesc('p.likes_count'),
                default      => $imageQuery->orderByDesc('p.likes_count')->orderByDesc('p.views_count'),
            };

            $feedProjects = $imageQuery->paginate(24)->withQueryString();

            $feedProjects->getCollection()->transform(function ($img) {
                if ($img->likes_count == 0) $img->likes_count = rand(10, 60);
                if ($img->views_count == 0) $img->views_count = rand(100, 500);
                return $img;
            });

        // ══════════════════════════════════════════
        // PROJECTS — query dari tabel projects
        // ══════════════════════════════════════════
        } elseif ($type !== 'people') {

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

            if ($keyword = $request->get('q')) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('p.title', 'like', "%{$keyword}%")
                      ->orWhere('p.description', 'like', "%{$keyword}%")
                      ->orWhere('u.name', 'like', "%{$keyword}%");
                });
            }

            if ($categorySlug = $request->get('category')) {
                $query->where('c.slug', $categorySlug);
            }

            if ($fields = $request->get('fields')) {
                $query->whereIn('c.slug', (array) $fields);
            }

            if ($tools = $request->get('tools')) {
                $query->where(function ($q) use ($tools) {
                    foreach ((array) $tools as $tool) {
                        $q->orWhereRaw("JSON_SEARCH(p.tools, 'one', ?) IS NOT NULL", [$tool]);
                    }
                });
            }

            if ($color = $request->get('color')) {
                $query->where('p.color', $color);
            }

            match ($sort) {
                'newest'     => $query->orderByDesc('p.created_at'),
                'popular'    => $query->orderByDesc('p.views_count'),
                'most_liked' => $query->orderByDesc('p.likes_count'),
                default      => $query->orderByDesc('p.likes_count')->orderByDesc('p.views_count'),
            };

            $feedProjects = $query->paginate(24)->withQueryString();

            $feedProjects->getCollection()->transform(function ($project) {
                if ($project->likes_count == 0)    $project->likes_count    = rand(8, 45);
                if ($project->comments_count == 0) $project->comments_count = rand(2, 12);
                if ($project->views_count == 0)    $project->views_count    = rand(100, 500);
                return $project;
            });
        }

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