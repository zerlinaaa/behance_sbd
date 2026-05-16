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
use App\Http\Controllers\Auth\RegisterTwoController;
use App\Http\Controllers\HireController;

// ── Halaman utama → explore
Route::get('/', function() {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('explore');
})->name('landing');

// ── Explore & detail project (publik)
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/projects/{slug}', [ExploreController::class, 'show'])->name('projects.show');

// ── Auth (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login',     function() { return view('auth.login'); })->name('login');
    Route::get('/register',  function() { return view('auth.register'); })->name('register');
    Route::get('/register2', [RegisterTwoController::class, 'show'])->name('register2.show');
});

Route::post('/login',    [LoginController::class,       'login'])->name('login.post');
Route::post('/register', [RegisterController::class,    'register'])->name('register.post');
Route::post('/register2',[RegisterTwoController::class, 'store'])->name('register2');
Route::post('/logout',   [LoginController::class,       'logout'])->name('logout');

// ── Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',           [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user/{id}', [DashboardController::class, 'userStats'])->name('dashboard.user');

    Route::get('/projects/create',      [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects',            [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{slug}',      [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{slug}',   [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::post('/projects/{id}/like',     [LikeController::class,    'toggle'])->name('likes.toggle');
    Route::post('/users/{id}/follow',      [FollowController::class,  'toggle'])->name('follows.toggle');
    Route::post('/projects/{id}/bookmark', [BookmarkController::class,'toggle'])->name('bookmarks.toggle');
});

// ── Resources (publik)
Route::get('/resources',              function() { return view('resources.overview'); })->name('resources.overview');
Route::get('/resources/guides',       function() { return view('resources.guides'); })->name('resources.guides');
Route::get('/resources/commissioned', function() { return view('resources.commissioned'); })->name('resources.commissioned');
Route::get('/resources/creative',     function() { return view('resources.creative'); })->name('resources.creative');

// ── Hire (publik)
Route::get('/hire/my-jobs',     [HireController::class, 'myJobs'])->name('hire.my-jobs');
Route::get('/hire/hiring',      [HireController::class, 'hiring'])->name('hire.hiring');
Route::get('/hire/freelancers', [HireController::class, 'freelance'])->name('hire.freelance');

// ── Halaman statis
Route::get('/jobs',        function() { return view('jobs'); })->name('jobs');
Route::get('/client-work', function() { return view('client_work'); })->name('client-work');