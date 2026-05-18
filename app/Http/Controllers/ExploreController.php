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

     if (auth()->check()) {
        return redirect()->route('dashboard');
    }
        $type = $request->get('type', 'projects');

        // ══════════════════════════════════════════════════
        // PEOPLE
        // ══════════════════════════════════════════════════
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

            if ($locations = $request->get('location')) {
                $peopleQuery->where(function ($q) use ($locations) {
                    foreach ((array) $locations as $loc) {
                        $q->orWhere('location', 'like', "%{$loc}%");
                    }
                });
            }

            $people = $peopleQuery
                ->orderByDesc('followers_count')
                ->get();
        }

        // ══════════════════════════════════════════════════
        // PROJECTS
        // ══════════════════════════════════════════════════
        $query = DB::table('projects as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('project_categories as pc', 'pc.project_id', '=', 'p.id')
            ->leftJoin('categories as c', 'c.id', '=', 'pc.category_id')
            ->selectRaw('DISTINCT
                p.id, p.title, p.slug, p.cover_image,
                p.likes_count, p.views_count, p.comments_count,
                p.created_at,
                u.id AS user_id, u.name AS creator_name,
                u.username AS creator_username, u.avatar AS creator_avatar,
                u.location AS creator_location, u.availability AS creator_availability
            ')
            ->where('p.status', 'published');

        // ── Filter: Keyword
        if ($keyword = $request->get('q')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('p.title', 'like', "%{$keyword}%")
                  ->orWhere('p.description', 'like', "%{$keyword}%")
                  ->orWhere('u.name', 'like', "%{$keyword}%")
                  ->orWhere('u.username', 'like', "%{$keyword}%");
            });
        }

        // ── Filter: Category (dari pill nav)
        if ($categorySlug = $request->get('category')) {
            $query->where('c.slug', $categorySlug);
        }

        // ── Filter: Creative Fields (dari sidebar, bisa multiple)
        if ($fields = $request->get('fields')) {
            $query->whereIn('c.slug', (array) $fields);
        }

        // ── Filter: Availability (bisa multiple)
        if ($availabilities = $request->get('availability')) {
            $query->whereIn('u.availability', (array) $availabilities);
        }

        // ── Filter: Location (bisa multiple)
        if ($locations = $request->get('location')) {
            $query->where(function ($q) use ($locations) {
                foreach ((array) $locations as $loc) {
                    $q->orWhere('u.location', 'like', "%{$loc}%");
                }
            });
        }

        // ── Filter: Tools (JSON search)
        if ($tools = $request->get('tools')) {
            $query->where(function ($q) use ($tools) {
                foreach ((array) $tools as $tool) {
                    $q->orWhereRaw("JSON_SEARCH(p.tools, 'one', ?) IS NOT NULL", [$tool]);
                }
            });
        }
    // ── Filter: Color
    if ($color = $request->get('color')) {
    $query->where('p.color', $color);
    }

        // ── Sort
        match ($request->get('sort', 'trending')) {
            'newest'     => $query->orderByDesc('p.created_at'),
            'popular'    => $query->orderByDesc('p.views_count'),
            'most_liked' => $query->orderByDesc('p.likes_count'),
            default      => $query->orderByDesc('p.likes_count')->orderByDesc('p.views_count'),
        };

        $perPage = auth()->check() ? 24 : 30;
        $projects = $query->paginate($perPage)->withQueryString();

        // ══════════════════════════════════════════════════
        // ASSETS
        // ══════════════════════════════════════════════════
        $assets = collect();

        if ($type === 'assets') {
            $assetQuery = DB::table('assets')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select(
                    'assets.id', 'assets.title', 'assets.slug', 'assets.cover_image', 'assets.description',
                    'assets.asset_type', 'assets.license', 'assets.price', 'assets.currency',
                    'assets.views_count', 'assets.likes_count', 'assets.status',
                    'users.name as owner_name',
                    'users.username as owner_username'
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

    match ($request->get('sort', 'trending')) {
        'newest'     => $assetQuery->orderByDesc('assets.id'),
        'popular'    => $assetQuery->orderByDesc('assets.views_count'),
        'most_liked' => $assetQuery->orderByDesc('assets.likes_count'),
        default      => $assetQuery->orderByDesc('assets.likes_count')->orderByDesc('assets.views_count'),
    };

    $assets = $assetQuery->paginate(40)->withQueryString();
}

// ══════════════════════════════════════════════════
// IMAGES
// ══════════════════════════════════════════════════
$images_list = collect();

if ($type === 'images') {
    $images_list = DB::table('project_images as pi')
        ->join('projects as p', 'p.id', '=', 'pi.project_id')
        ->join('users as u', 'u.id', '=', 'p.user_id')
        ->select(
            'pi.id', 'pi.image_url', 'p.title', 'p.slug',
            'p.likes_count', 'u.name as creator_name',
            'u.username as creator_username', 'u.avatar as creator_avatar'
        )
        ->where('p.status', 'published')
        ->orderByDesc('p.likes_count')
        ->paginate(60)
        ->withQueryString();
}

        // ── Kategori untuk pill nav + sidebar
        $categories = DB::table('categories as c')
            ->leftJoin('project_categories as pc', 'pc.category_id', '=', 'c.id')
            ->selectRaw('c.id, c.name, c.slug, c.icon, COUNT(pc.id) AS project_count')
            ->where('c.is_active', 1)
            ->groupBy('c.id', 'c.name', 'c.slug', 'c.icon')
            ->orderByDesc('project_count')
            ->get();

        // ── Data untuk sidebar filter
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

        if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
    return response()->json([
        'projects' => $projects->items(),
        'has_more' => $projects->hasMorePages(),
    ]);
}

return view('explore', compact(
    'projects', 'assets', 'images_list', 'categories', 'locations',
    'availabilityOptions', 'toolOptions', 'colorOptions',
    'people', 'type'
));
    }

    /**
     * Halaman detail project
     * Route: GET /projects/{slug}
     */
    public function show(string $slug)
    {
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

        $images = DB::table('project_images')
            ->where('project_id', $project->id)
            ->orderBy('sort_order')
            ->get();

        $comments = DB::table('comments as cm')
            ->join('users as u', 'u.id', '=', 'cm.user_id')
            ->select('cm.*', 'u.name', 'u.avatar', 'u.username')
            ->where('cm.project_id', $project->id)
            ->whereNull('cm.parent_id')
            ->where('cm.is_approved', 1)
            ->orderByDesc('cm.created_at')
            ->get();

        DB::table('projects')
            ->where('id', $project->id)
            ->increment('views_count');

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