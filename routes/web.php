<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel/{slug}', [HomeController::class, 'show'])->name('article.show');
Route::get('/kategori/{slug}', [HomeController::class, 'category'])->name('category.show');

// Auth Routes
Auth::routes();

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
});