<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(int $id)
    {
        $userId   = auth()->id();
        $existing = Like::where('user_id', $userId)
                        ->where('project_id', $id)
                        ->first();

        if ($existing) {
            $existing->delete();
            DB::table('projects')->where('id', $id)->decrement('likes_count');
            $action = 'unliked';
        } else {
            Like::create([
                'user_id'    => $userId,
                'project_id' => $id,
            ]);
            DB::table('projects')->where('id', $id)->increment('likes_count');
            $action = 'liked';
        }

        // ✅ Hitung langsung dari tabel likes (akurat)
        $likesCount = DB::table('likes')
                        ->where('project_id', $id)
                        ->count();

        // ✅ Sync kolom likes_count agar selalu akurat
        DB::table('projects')
            ->where('id', $id)
            ->update(['likes_count' => $likesCount]);

        return response()->json([
            'action'      => $action,
            'likes_count' => $likesCount,
        ]);
    }

}