<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminExerciseController;
use App\Http\Controllers\Admin\AdminTemplateController;
use App\Http\Controllers\Admin\AdminUserController;
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

// Account settings routes
Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\User\AccountController::class, 'index'])->name('index');
    Route::post('/avatar', [App\Http\Controllers\User\AccountController::class, 'updateAvatar'])->name('avatar.update');
    Route::delete('/avatar', [App\Http\Controllers\User\AccountController::class, 'deleteAvatar'])->name('avatar.delete');
    Route::get('/password', [App\Http\Controllers\User\AccountController::class, 'showPasswordForm'])->name('password');
    Route::post('/password', [App\Http\Controllers\User\AccountController::class, 'updatePassword'])->name('password.update');
});

// Admin Auth Routes
Route::get('/admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Middleware Aliases
Route::aliasMiddleware('admin', AdminMiddleware::class);

// User - Admin routes (with admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // exercises and templates
    Route::resource('/exercises', AdminExerciseController::class);
    Route::resource('/templates', AdminTemplateController::class);

    // user management
    Route::resource('/users', AdminUserController::class);
    Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::patch('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

// User - Protected routes (with setup middleware)
Route::middleware(['auth', 'setup'])->group(function () {
    // dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // menu
    Route::resource('menus', MenuController::class);

    // exercises
    Route::post('/menus/{menu}/exercises', [MenuController::class, 'addExercises'])->name('menus.exercises.add');
    Route::put('/menus/{menu}/exercises/{exercise}', [MenuController::class, 'updateExerciseDetails'])->name('menus.exercises.update');
    Route::post('/menus/{menu}/exercises/reorder', [MenuController::class, 'reorderExercises'])->name('menus.exercises.reorder');
    Route::post('/menus/from-template/{template}', [MenuController::class, 'createFromTemplate'])->name('menus.from-template');

    // training records
    Route::resource('training-records', TrainingRecordController::class);

    // training history
    Route::resource('training-history', TrainingHistoryController::class)->except(['show']);
    Route::get('/training-history/show/{id}', [TrainingHistoryController::class, 'show'])->name('training-history.show');

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
