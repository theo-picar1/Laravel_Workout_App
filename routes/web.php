<?php

use App\Http\Controllers\EquipmentTypesController;
use App\Http\Controllers\RoutinesController;
use Illuminate\Support\Facades\Route;

// Basically importing the Controllers to make use of them. Like Java
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;

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

Route::get('/workout', [PagesController::class, 'workoutPage'])->name('pages.workout');

Route::get('/profile', [PagesController::class, 'profilePage'])->name('pages.profile');

Route::get('/exercises', [PagesController::class, 'exercisesPage'])->name('pages.exercises');

Route::get('/discover', [PostController::class, 'index'])->name('pages.discover');

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

Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

// To delete profile
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// To add a new routine 
Route::post('/workout', [RoutinesController::class, 'store'])->name('routines.store');

// To update a routine
Route::put('/workout/{routineId}', [RoutinesController::class, 'update'])->name('routines.update');

// To delete a routine
Route::delete('/workout/{routineId}', [RoutinesController::class, 'destroy'])->name('routines.destroy');

// Route::post('/verify-password', [PasswordVerificationController::class, 'verify'])->name('password.verify');

Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');

Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');