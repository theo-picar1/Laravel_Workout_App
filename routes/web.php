<?php

use App\Http\Controllers\EquipmentTypesController;
use Illuminate\Support\Facades\Route;

// Basically importing the Controllers to make use of them. Like Java
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExercisesController;

Auth::routes();

// Get index.blade.php inside the auth folder of views
Route::get('/', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        return redirect()->route('pages.workout');
    }
    
    return view('auth.index');
});

// Gets the authentication page with login and register forms
Route::get('/authentication', [PagesController::class, 'authenticationPage'])->name('auth.index');

// Get the workout page within the pages folder. The return view is defined in WorkoutController
// '/workout' is the URL (for the user), 'index' is the method name in the PagesController', and 'pages.workout' is just the name for the route. Can be anything as long as they match
Route::get('/workout', [PagesController::class, 'workoutPage'])->name('pages.workout');

Route::get('/profile', [PagesController::class, 'profilePage'])->name('pages.profile');

Route::get('/exercises', [PagesController::class, 'exercisesPage'])->name('pages.exercises');

Route::get('/discover', [PagesController::class, 'discoverPage'])->name('pages.discover');

// All the auth routes. This is a built in thing when running 'composer require laravel/ui'
Auth::routes();

// For logging in a user
Route::post('/login', [LoginController::class, 'login'])->name('login');

// To add a new exercise to the database
Route::post('/exercises', [ExercisesController::class, 'store'])->name('exercises.store');

// To edit existing exercise
Route::put('/exercises/{exercise}', [ExercisesController::class, 'update'])->name('exercises.update');

// To delete the exercise
Route::delete('/exercises/{id}', [ExercisesController::class, 'destroy'])->name('exercises.destroy');