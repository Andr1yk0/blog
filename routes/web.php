<?php

use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AboutController::class, 'about'])->name('about');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/tests', [TestsController::class, 'index'])->name('tests.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');

Auth::routes();

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', PostAdminController::class);
});

