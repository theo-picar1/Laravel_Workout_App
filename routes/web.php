<?php

use Illuminate\Support\Facades\Route;

// Get index.blade.php inside the auth folder of views
Route::get('/', function () {
    return view('pages.workout');
});
