<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HireController;

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

// ── Auth Manual (Sudah Diperbaiki) ──
// Route untuk menampilkan halaman (View)
Route::get('/login',    fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/login',    [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout'); // ← tambah ini

// Route untuk memproses data (Logic)
Route::post('/login',    [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/register2', fn() => view('auth.register2'))->name('register2');

// ── Resources & Hire (Tetap Sama) ──
Route::get('/resources',            fn() => view('resources.overview'))->name('resources.overview');
Route::get('/resources/guides',     fn() => view('resources.guides'))->name('resources.guides');
Route::get('/resources/commissioned', fn() => view('resources.commissioned'))->name('resources.commissioned');
Route::get('/resources/creative',   fn() => view('resources.creative'))->name('resources.creative');

Route::get('/hire/my-jobs', [HireController::class, 'myJobs'])->name('hire.my-jobs');
Route::get('/hire/hiring', [HireController::class, 'hiring'])->name('hire.hiring');
Route::get('/hire/freelancers', [HireController::class, 'freelance'])->name('hire.freelance');

Route::get('landing',    fn() => view('landing'))->name('landing');
Route::get('jobs',    fn() => view('jobs'))->name('jobs');

Route::post('/register2', [RegisterController::class, 'register2'])->name('register2.post');