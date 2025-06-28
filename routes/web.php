<?php

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

    return redirect('/home');
});

// Laravelの認証ルート（ログイン・登録）
Auth::routes();

// ホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 認証されたユーザーだけがアクセスできるルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
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
