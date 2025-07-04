<?php

use App\Http\Controllers\User\BodyRecordController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GoalController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('profile.index');
    }

    return redirect()->route('login');
});

// Laravel certification route（login・register・reset password）
Auth::routes();

// User - Setup routes (no middleware)
Route::middleware('auth')->group(function () {

    // profile (required)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // goal (required)
    Route::resource('goal', GoalController::class)->except(['show']);

});

// User - Protected routes (with setup middleware)
Route::middleware(['auth', 'setup'])->group(function () {
    // dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // menu
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/show', [MenuController::class, 'show'])->name('menu.show');
    Route::get('/menu/edit', [MenuController::class, 'edit'])->name('menu.edit');

    // home route (for compatibility)
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // body record
    Route::resource('body-records', BodyRecordController::class);
});
