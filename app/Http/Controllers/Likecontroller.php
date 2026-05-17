<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

class LikeController extends Controller
{
    /** Toggle like/unlike — POST /projects/{id}/like */
    public function toggle(int $id)
    {
        $userId   = auth()->id();
        $existing = Like::where('user_id', $userId)
                        ->where('project_id', $id)
                        ->first();

        if ($existing) {
            $existing->delete();
            $action = 'unliked';
        } else {
            Like::create([
                'user_id'    => $userId,
                'project_id' => $id,
            ]);
            $action = 'liked';
        }

        $likesCount = DB::table('projects')
                        ->where('id', $id)
                        ->value('likes_count');

        return response()->json([
            'action'      => $action,
            'likes_count' => $likesCount,
        ]);
    }
}