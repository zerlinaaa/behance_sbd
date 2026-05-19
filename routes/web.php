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
use App\Http\Controllers\CommentController;

Route::get('/', function() {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('explore');
})->name('landing');

Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/assets/{slug}', [App\Http\Controllers\AssetController::class, 'show'])->name('assets.show');

Route::middleware('guest')->group(function () {
    Route::get('/login',     function() { return view('auth.login'); })->name('login');
    Route::get('/register',  function() { return view('auth.register'); })->name('register');
    Route::get('/register2', [RegisterTwoController::class, 'show'])->name('register2.show');
});

Route::post('/login',    [LoginController::class,    'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/register2',[RegisterTwoController::class, 'store'])->name('register2');
Route::post('/logout',   [LoginController::class,    'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',           [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user/{id}', [DashboardController::class, 'userStats'])->name('dashboard.user');

    Route::get('/projects/create',      [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects',            [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{slug}',      [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{slug}',   [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::post('/projects/{id}/like',     [LikeController::class,     'toggle'])->name('likes.toggle');
    Route::post('/users/{id}/follow',      [FollowController::class,   'toggle'])->name('follows.toggle');
    Route::post('/projects/{id}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::post('/projects/{id}/comments', [CommentController::class,  'store'])->name('comments.store');
    Route::post('/users/{id}/hire',        [HireController::class,     'store'])->name('hire.store');

    Route::post('/profile/avatar',   [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'removeAvatar'])->name('profile.removeAvatar');
    Route::put('/profile',           [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/banner',   [App\Http\Controllers\ProfileController::class, 'updateBanner'])->name('profile.updateBanner');
    Route::post('/profile/banner',   [App\Http\Controllers\ProfileController::class, 'updateBanner'])->name('profile.updateBanner');
});

Route::get('/resources',              function() { return view('resources.overview'); })->name('resources.overview');
Route::get('/resources/guides',       function() { return view('resources.guides'); })->name('resources.guides');
Route::get('/resources/commissioned', function() { return view('resources.commissioned'); })->name('resources.commissioned');
Route::get('/resources/creative',     function() { return view('resources.creative'); })->name('resources.creative');

Route::get('/hire/my-jobs',     [HireController::class, 'myJobs'])->name('hire.my-jobs');
Route::get('/hire/hiring',      [HireController::class, 'hiring'])->name('hire.hiring');
Route::get('/hire/freelancers', [HireController::class, 'freelance'])->name('hire.freelance');

Route::get('/jobs',        function() { return view('jobs'); })->name('jobs');
Route::get('/client-work', function() { return view('client_work'); })->name('client-work');
Route::get('/users/{username}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

// Harus PALING BAWAH
Route::get('/projects/{slug}', [ExploreController::class, 'show'])->name('projects.show');

