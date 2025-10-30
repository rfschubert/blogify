<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post;
use App\Http\Controllers\Authentication;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/posts', [Post::class, 'index'])->name('posts.index');
Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'login'])->name('login.post');
Route::post('/logout', [Authentication::class, 'logout'])->name('logout');
Route::get('/register', [Authentication::class, 'register'])->name('register');
Route::post('/register', [Authentication::class, 'register'])->name('register');
Route::get('/users', [Authentication::class, 'list_users'])->name('users.list');
