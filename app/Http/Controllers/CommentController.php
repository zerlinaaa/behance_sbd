<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, int $projectId)
    {
        $request->validate(['content' => 'required|string|max:1000']);

        Comment::create([
            'user_id'    => auth()->id(),
            'project_id' => $projectId,
            'comment_text' => $request->content,
            'is_approved'  => true,
        ]);

        return back();
    }
}