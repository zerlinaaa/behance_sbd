<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function show(string $slug)
    {
        $asset = DB::table('assets as a')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('
                a.*,
                u.name     AS creator_name,
                u.username AS creator_username,
                u.avatar   AS creator_avatar,
                u.bio      AS creator_bio,
                u.followers_count
            ')
            ->where('a.slug', $slug)
            ->firstOrFail();

        if ($asset->followers_count == 0) {
            $asset->followers_count = rand(150, 2500);
        }

        DB::table('assets')
            ->where('id', $asset->id)
            ->increment('views_count');

        $related = DB::table('assets')
            ->where('user_id', $asset->user_id)
            ->where('id', '!=', $asset->id)
            ->where('status', 'published')
            ->orderByDesc('likes_count')
            ->limit(4)
            ->get();

        return view('assets.show', compact('asset', 'related'));
    }
}