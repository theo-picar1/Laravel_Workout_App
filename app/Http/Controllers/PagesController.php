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

        return view('pages.workout', compact('routines'));
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
        return view('pages.discover');
    }

    public function discover()
    {
        // Fetch all users except the currently authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // Fetch all posts with their related user and routine
        $posts = Post::with(['user', 'routine'])->latest()->get();

        // Fetch routines created by the authenticated user
        $routines = auth()->user()->routines; 

        // Pass the users, posts, and routines to the view
        return view('pages.discover', compact('users', 'posts', 'routines'));
    }
}