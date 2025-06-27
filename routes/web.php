<?php

use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }

    return view('welcome');
});

// Goal routes
Route::middleware('auth')->group(function () {
    Route::resource('goal', GoalController::class)->except(['show']);
});
