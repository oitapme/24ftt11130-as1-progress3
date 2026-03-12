<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(IsAdminMiddleware::class)->group(function () { 
        Route::resource('categories', CategoryController::class); 
        Route::resource('posts', PostController::class);
        Route::resource('images', ImageController::class);
    });

    Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('article', 'article')->name('article');

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/second', 'second')->name('second');
Route::view('/website', 'website')->name('website');

require __DIR__.'/auth.php';