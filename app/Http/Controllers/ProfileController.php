<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(string $username)
    {
        $user = DB::table('users')->where('username', $username)->firstOrFail();

        $projects = DB::table('projects')
            ->where('user_id', $user->id)
            ->where('status', 'published')
            ->orderByDesc('likes_count')
            ->get();

        $drafts = collect();
        $appreciations = collect();
        $stats = null;

        if (auth()->check() && auth()->id() === $user->id) {
            // Drafts: project milik user dengan status draft
            $drafts = DB::table('projects')
                ->where('user_id', $user->id)
                ->where('status', 'draft')
                ->orderByDesc('created_at')
                ->get();

            // Stats dari creator_stats view
            $stats = DB::table('creator_stats')
                ->where('user_id', $user->id)
                ->first();
        }

        // Appreciations: project yang di-like oleh user ini
        if (auth()->check()) {
            $appreciations = DB::table('projects')
                ->join('likes', 'projects.id', '=', 'likes.project_id')
                ->join('users as u', 'projects.user_id', '=', 'u.id')
                ->where('likes.user_id', $user->id)
                ->where('projects.status', 'published')
                ->orderByDesc('likes.created_at')
                ->select(
                    'projects.id',
                    'projects.title',
                    'projects.slug',
                    'projects.cover_image',
                    'projects.likes_count',
                    'projects.views_count',
                    'u.name as creator_name',
                    'u.username as creator_username'
                )
                ->get();
        }

        $isFollowing = false;
        if (auth()->check()) {
            $isFollowing = DB::table('follows')
                ->where('follower_id', auth()->id())
                ->where('following_id', $user->id)
                ->exists();
        }

        return view('profile.show', compact(
            'user', 'projects', 'isFollowing',
            'drafts', 'appreciations', 'stats'
        ));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'location'   => 'nullable|string|max:100',
            'bio'        => 'nullable|string|max:500',
        ]);

        $name = trim($request->first_name . ' ' . $request->last_name);

        DB::table('users')
            ->where('id', auth()->id())
            ->update([
                'name'     => $name,
                'location' => $request->location,
                'bio'      => $request->bio,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $file = $request->file('avatar');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        // Buat folder jika belum ada
        if (!file_exists(public_path('uploads/avatars'))) {
            mkdir(public_path('uploads/avatars'), 0755, true);
        }

        $file->move(public_path('uploads/avatars'), $filename);
        $avatarPath = '/uploads/avatars/' . $filename;

        DB::table('users')
            ->where('id', auth()->id())
            ->update(['avatar' => $avatarPath, 'updated_at' => now()]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function removeAvatar()
    {
        DB::table('users')
            ->where('id', auth()->id())
            ->update(['avatar' => null, 'updated_at' => now()]);

        return back()->with('success', 'Foto profil berhasil dihapus!');
    }
    public function updateBanner(Request $request)
    {
        $request->validate([
            'banner' => 'required|image|max:5120',
        ]);

        $file = $request->file('banner');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        if (!file_exists(public_path('uploads/banners'))) {
            mkdir(public_path('uploads/banners'), 0755, true);
        }

        $file->move(public_path('uploads/banners'), $filename);
        $bannerPath = '/uploads/banners/' . $filename;

        DB::table('users')
            ->where('id', auth()->id())
            ->update(['banner' => $bannerPath, 'updated_at' => now()]);

        return back()->with('success', 'Banner berhasil diperbarui!');
        }

}
