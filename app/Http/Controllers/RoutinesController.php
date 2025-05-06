<?php

namespace App\Http\Controllers;

use App\Models\Routines;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class RoutinesController extends Controller
{
    public function index()
    {
        $exercises = Routines::all();

        // It will be used in exercises.blade.php
        return view('pages.workout', compact('routines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'routine_name' => 'required|string|max:255'
        ]);

        $validated['user_id'] = Auth::id(); // Because we're using laravel's built in login/register, we can just do this

        Routines::create($validated);

        return redirect()->back()->with('success', 'Routine added successfully!');
    }
}
