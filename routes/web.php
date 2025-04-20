<?php

use Illuminate\Support\Facades\Route;

// Basically importing the Controllers to make use of them. Like Java
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();

// Get index.blade.php inside the auth folder of views
Route::get('/', function () {
    return view('auth.index');
});

// Get the workout page within the pages folder. The return view is defined in WorkoutController
// '/workout' is the URL (for the user), 'index' is the method name in the PagesController', and 'pages.workout' is just the name for the route. Can be anything as long as they match
Route::get('/workout', [PagesController::class, 'index'])->name('pages.workout');

// All the auth routes. This is a built in thing when running 'composer require laravel/ui'
Auth::routes();

// For logging in a user
Route::post('/login', [LoginController::class, 'login'])->name('login');