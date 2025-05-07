<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Fetch all users except the currently authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // Fetch all posts with their related user and likes
        $posts = Post::with(['user', 'likes', 'routine'])->latest()->get();

        // Fetch routines created by the authenticated user
        $routines = auth()->user()->routines;

        // Pass the users, posts, and routines to the view
        return view('pages.discover', compact('users', 'posts', 'routines'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'routine_id' => 'nullable|exists:routines,routine_id',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'routine_id' => $request->input('routine_id'),
        ]);

        return redirect()->route('pages.discover')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
