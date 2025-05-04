<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercises;

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
}
