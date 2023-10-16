<?php

use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\Admin\TestAdminController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestsController;

Route::get('/', [AboutController::class, 'about'])->name('about');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/tests', [TestsController::class, 'index'])->name('tests.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');

Auth::routes();

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', PostAdminController::class);
    Route::resource('tests', TestAdminController::class);
    Route::resource('tags', TagAdminController::class);
});

