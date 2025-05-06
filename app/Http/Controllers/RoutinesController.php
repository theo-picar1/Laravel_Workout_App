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
        $routines = Routines::all();

        // It will be used in routiness.blade.php
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

    public function update(Request $request, $id)
    {
        $routines = Routines::findOrFail($id);

        $request->validate([
            'routine_name' => 'required|string|max:255'
        ]);

        $routines->update([
            'routine_name' => $request->input('routine_name')
        ]);

        return redirect()->back()->with('Update routine success', 'Routine updated successfully');
    }

    public function destroy($id)
    {
        $routines = Routines::findOrFail($id);
        $routines->delete();

        return redirect()->back()->with('Deleted routine success', 'Routine deleted successfully!');
    }
}
