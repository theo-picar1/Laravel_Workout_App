<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercises;
use App\Models\EquipmentTypes;
use App\Models\Routines;
use App\Models\User;
use App\Models\Post;

class PagesController extends Controller
{
    // This function will return the workout page view along with data from the routines and exercise_routine table
    public function workoutPage() {
        $routines = Routines::all();
        $exercises = Exercises::all();

        return view('pages.workout', compact('routines', 'exercises'));
    }

    // Returns the authentication view page
    public function authenticationPage() {
        return view('auth.index');
    }

    // Returns the profile page view
    public function profilePage()
    {
        $user = auth()->user();

        // Pass the authenticated user to the view
        return view('pages.profile', compact('user'));
    }

    // Returns the exercises page view along with data from the exercises and quipment-types tables
    public function exercisesPage() {
        $exercises = Exercises::all();
        $equipment_types = EquipmentTypes::all();

        return view('pages.exercises', compact('exercises', 'equipment_types'));
    }

    // Returns the profile page view
    public function discoverPage() {
        // Fetch all users except the currently authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // Fetch all posts with their related user and likes
        $posts = Post::with(['user', 'likes'])->latest()->get();

        return view('pages.discover', compact('users', 'posts'));
    }
}