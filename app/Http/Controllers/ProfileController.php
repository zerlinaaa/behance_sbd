<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show(string $username)
    {
        $user = DB::table('users')
            ->where('username', $username)
            ->firstOrFail();

        $projects = DB::table('projects')
            ->where('user_id', $user->id)
            ->where('status', 'published')
            ->orderByDesc('likes_count')
            ->get();

        $isFollowing = false;
        if (auth()->check()) {
            $isFollowing = DB::table('follows')
                ->where('follower_id', auth()->id())
                ->where('following_id', $user->id)
                ->exists();
        }

        return view('profile.show', compact('user', 'projects', 'isFollowing'));
    }
}