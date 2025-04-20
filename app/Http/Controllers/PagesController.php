<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // This function will return the workout page view
    public function index() {
        return view('pages.workout');
    }
}
