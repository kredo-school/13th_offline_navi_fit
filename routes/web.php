<?php

use App\Http\Controllers\BodyRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Laravel certification route（login・register・reset password）
Auth::routes();

// User
Route::middleware('auth')->group(function () {

    // profile (required)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // goal (required)
    Route::resource('goal', GoalController::class)->except(['show']);

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // home route (for compatibility)
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // body record
    Route::resource('body-records', BodyRecordController::class);
});
