<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Pastikan model Category di-import
use App\Models\Category; 

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // Ambil parameter sort dari URL, default ke 'trending'
    $sort = $request->query('sort', 'trending');

    // Query dasar
    $query = DB::table('projects as p')
        ->join('users as u', 'u.id', '=', 'p.user_id')
        ->select([
            'p.*', 
            'u.name as creator_name', 
            'u.username as creator_username', 
            'u.avatar as creator_avatar'
        ])
        ->where('p.status', 'published');

    // Logika pengurutan berdasarkan pilihan dropdown
    switch ($sort) {
        case 'newest':
            $query->orderByDesc('p.created_at');
            break;
        case 'popular':
            $query->orderByDesc('p.views_count');
            break;
        case 'most_liked':
            $query->orderByDesc('p.likes_count');
            break;
        case 'trending':
        default:
            // Gabungan likes dan views untuk trending
            $query->orderByDesc('p.likes_count')->orderByDesc('p.views_count');
            break;
    }

    $feedProjects = $query->paginate(24)->withQueryString();
    $categories = Category::all();

    return view('dashboard', compact('feedProjects', 'categories'));
} }