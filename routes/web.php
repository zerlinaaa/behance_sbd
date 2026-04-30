<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\BookmarkController;

// ── Halaman utama → explore
Route::get('/', fn() => redirect()->route('explore'));

// ── Explore & detail project (publik)
Route::get('/explore',               [ExploreController::class, 'index'])->name('explore');
Route::get('/projects/{slug}',        [ExploreController::class, 'show'])->name('projects.show');

// ── Dashboard
Route::get('/dashboard',             [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/user/{id}',   [DashboardController::class, 'userStats'])->name('dashboard.user');

// ── CRUD + interaksi (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/projects/create',         [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects',               [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{slug}/edit',    [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{slug}',         [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{slug}',      [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('/projects/{id}/like',     [LikeController::class,    'toggle'])->name('likes.toggle');
    Route::post('/users/{id}/follow',      [FollowController::class,  'toggle'])->name('follows.toggle');
    Route::post('/projects/{id}/bookmark', [BookmarkController::class,'toggle'])->name('bookmarks.toggle');
});

// ── Auth manual
Route::get('/login',     fn() => view('auth.login'))->name('login');
Route::get('/register',  fn() => view('auth.register'))->name('register');
Route::post('/login',    [\App\Http\Controllers\Auth\LoginController::class,   'login'])->name('login.post');
Route::post('/logout',   [\App\Http\Controllers\Auth\LoginController::class,   'logout'])->name('logout');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class,'register'])->name('register.post');