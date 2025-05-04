<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercises;

class PagesController extends Controller
{
    // This function will return the workout page view
    public function workoutPage() {
        return view('pages.workout');
    }

    // Returns the authentication view page
    public function authenticationPage() {
        return view('auth.index');
    }

    // Returns the profile page view
    public function profilePage() {
        return view('pages.profile');
    }

    // Returns the exercises page view
    public function exercisesPage() {
        $exercises = Exercises::all();

        return view('pages.exercises');
    }
}
