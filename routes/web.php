<?php

use Illuminate\Support\Facades\Route;

// Basically importing the Controllers to make use of them. Like Java
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\PagesController;

Auth::routes();

// Get index.blade.php inside the auth folder of views
Route::get('/', function () {
    return view('auth.index');
});

// Get the workout page within the pages folder. The return view is defined in WorkoutController
Route::get('/workout', [PagesController::class, 'index'])->name('pages.workout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
