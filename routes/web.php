<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// トップページのルート
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
