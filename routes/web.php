<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('article', 'article')->name('article');

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/second', 'second')->name('second');
Route::view('/website', 'website')->name('website');

require __DIR__.'/auth.php';