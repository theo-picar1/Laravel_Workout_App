<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->following()->where('following_id', $user->id)->exists()) {
            // Unfollow the user
            $currentUser->following()->detach($user->id);
            $status = 'unfollowed';
        } else {
            // Follow the user
            $currentUser->following()->attach($user->id);
            $status = 'followed';
        }

        return response()->json([
            'status' => $status,
            'followers_count' => $user->followers()->count(),
        ]);
    }
}
