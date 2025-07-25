<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminExerciseController;
use App\Http\Controllers\Admin\AdminTemplateController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\User\BodyRecordController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GoalController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TrainingHistoryController;
use App\Http\Controllers\User\TrainingRecordController;
use App\Http\Middleware\AdminMiddleware;
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

// User - Admin routes (with admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // exercises and templates
    Route::resource('/exercises', AdminExerciseController::class);
    Route::resource('/templates', AdminTemplateController::class);

    // user management
    Route::aliasMiddleware('admin', AdminMiddleware::class);
});

// User - Protected routes (with setup middleware)
Route::middleware(['auth', 'setup'])->group(function () {
    // dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // menu
    Route::resource('menus', MenuController::class);

    // training records
    // Route::resource('training-records', TrainingRecordController::class);

    // training history
    Route::resource('training-history', TrainingHistoryController::class)->except(['show']);
    Route::get('/training-history/show', [TrainingHistoryController::class, 'show']);

    // home route (for compatibility)
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // body record
    Route::resource('body-records', BodyRecordController::class);
});

// API routes
Route::middleware(['auth', 'setup'])->prefix('api')->group(function () {
    Route::get('/exercises/search', [ExerciseController::class, 'search']);
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);
    Route::get('/templates', [TemplateController::class, 'index']);
    Route::get('/templates/{template}', [TemplateController::class, 'show']);
});
