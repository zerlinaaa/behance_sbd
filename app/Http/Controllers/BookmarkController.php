<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    /** Toggle bookmark/unbookmark — POST /projects/{id}/bookmark */
    public function toggle(Request $request, int $projectId)
    {
        $userId   = auth()->id();
        $existing = Bookmark::where('user_id', $userId)
                            ->where('project_id', $projectId)
                            ->first();

        if ($existing) {
            $existing->delete();
            $action = 'removed';
        } else {
            Bookmark::create([
                'user_id'         => $userId,
                'project_id'      => $projectId,
                'collection_name' => $request->input('collection', 'Saved'),
            ]);
            $action = 'saved';
        }

        return response()->json(['action' => $action]);
    }
}