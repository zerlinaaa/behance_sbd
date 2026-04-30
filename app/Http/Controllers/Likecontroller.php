<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

class LikeController extends Controller
{
    /** Toggle like/unlike — POST /projects/{id}/like */
    public function toggle(int $projectId)
    {
        $userId   = auth()->id();
        $existing = Like::where('user_id', $userId)
                        ->where('project_id', $projectId)
                        ->first();

        if ($existing) {
            $existing->delete();            // → Trigger otomatis -1 likes_count
            $action = 'unliked';
        } else {
            Like::create([                  // → Trigger otomatis +1 likes_count
                'user_id'    => $userId,
                'project_id' => $projectId,
            ]);
            $action = 'liked';
        }

        $likesCount = DB::table('projects')
                        ->where('id', $projectId)
                        ->value('likes_count');

        return response()->json([
            'action'      => $action,
            'likes_count' => $likesCount,
        ]);
    }
}