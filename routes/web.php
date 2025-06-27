<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Auth::routes();

// Auth
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }

    return view('welcome');
});

// User
Route::middleware('auth')->group(function () {
    // profile (required)

    // goal (required)

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // redirect to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
});
