<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercises;

use Illuminate\Support\Facades\Log;

// So that, you know, we can actually use the exercises database
class ExercisesController extends Controller
{
    // To get all exercises from the database to be able to display them
    public function index()
    {
        $exercises = Exercises::all();

        // It will be used in exercises.blade.php
        return view('pages.exercises', compact('exercises'));
    }

    // To display an exercise by ID
    public function show($exerciseId)
    {
        $exercise = Exercises::findOrFail($exerciseId);

        // It will also be used in exercises.blade.php
        return view('pages.exercises', compact('exercise'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'equipment_type_id' => 'required|exists:equipment_types,equipment_type_id'
        ]);

        Exercises::create($validated);

        return redirect()->back()->with('Added exercise success', 'Exercise added successfully!');
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercises::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'equipment_type_id' => 'required|exists:equipment_types,equipment_type_id',
        ]);

        $exercise->update([
            'name' => $request->input('name'),
            'equipment_type_id' => $request->input('equipment_type_id'),
        ]);

        return redirect()->back()->with('Update exercise success', 'Exercise updated successfully');
    }

    public function destroy($id)
    {
        $exercise = Exercises::findOrFail($id);
        $exercise->delete();

        return redirect()->back()->with('Deleted exercise success', 'Exercise deleted successfully!');
    }
}
