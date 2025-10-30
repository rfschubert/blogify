<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Authentication;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/import/posts', [PostController::class, 'importForm'])->name('posts.import.form');
    Route::post('/import/posts', [PostController::class, 'import'])->name('posts.import');
});

Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'login'])->name('login.post');
Route::post('/logout', [Authentication::class, 'logout'])->name('logout');
Route::get('/register', [Authentication::class, 'register'])->name('register');
Route::post('/register', [Authentication::class, 'register'])->name('register');
