<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Post $post)
    {
        $user = auth()->user();

        // Check if the user already liked the post
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Unlike the post
            $like->delete();
            $status = 'unliked';
        } else {
            // Like the post
            $post->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'like_count' => $post->likes()->count(),
        ]);
    }
}
