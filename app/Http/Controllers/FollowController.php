<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    /** Toggle follow/unfollow — POST /users/{id}/follow */
    public function toggle(int $userId)
    {
        $authId = auth()->id();

        // Tidak boleh follow diri sendiri
        if ($authId === $userId) {
            return response()->json(['error' => 'Tidak bisa follow diri sendiri.'], 422);
        }

        $existing = Follow::where('follower_id', $authId)
                          ->where('following_id', $userId)
                          ->first();

        if ($existing) {
            $existing->delete();            // → booted() otomatis decrement counter
            $action = 'unfollowed';
        } else {
            Follow::create([               // → booted() otomatis increment counter
                'follower_id'  => $authId,
                'following_id' => $userId,
            ]);
            $action = 'followed';
        }

        $followersCount = User::where('id', $userId)->value('followers_count');

        return response()->json([
            'action'          => $action,
            'followers_count' => $followersCount,
        ]);
    }
}