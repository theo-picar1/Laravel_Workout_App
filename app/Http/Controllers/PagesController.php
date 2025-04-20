<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
