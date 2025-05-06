<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercises;
use App\Models\EquipmentTypes;
use App\Models\Routines;

class PagesController extends Controller
{
    // This function will return the workout page view along with data from the routines and exercise_routine table
    public function workoutPage() {
        $routines = Routines::all();

        return view('pages.workout', compact('routines'));
    }

    // Returns the authentication view page
    public function authenticationPage() {
        return view('auth.index');
    }

    // Returns the profile page view
    public function profilePage() {
        return view('pages.profile');
    }

    // Returns the exercises page view along with data from the exercises and quipment-types tables
    public function exercisesPage() {
        $exercises = Exercises::all();
        $equipment_types = EquipmentTypes::all();

        return view('pages.exercises', compact('exercises', 'equipment_types'));
    }

    // Returns the profile page view
    public function discoverPage() {
        return view('pages.discover');
    }
}
