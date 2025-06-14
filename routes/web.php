<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ContactRequestAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GoogleAuthController;
use App\Http\Controllers\Admin\MediaAdminController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\SettingsAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AboutController::class, 'about'])->name('about');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');
Route::get('/posts/tagged/{tag:slug}', [PostsController::class, 'index'])->name('posts.index.tagged');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/cookie-policy', [ContactsController::class, 'cookiePolicy'])->name('cookie-policy');
Route::get('/privacy-policy', [ContactsController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [ContactsController::class, 'terms'])->name('terms');

\Auth::routes(['register' => false, 'confirm' => false]);

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::post('/posts/upload-image', [PostAdminController::class, 'uploadImage'])
        ->name('posts.upload-image');
    Route::post('/posts/index-now/{post}', [PostAdminController::class, 'indexNow'])
        ->name('posts.index-now');
    Route::resource('posts', PostAdminController::class);
    Route::resource('tags', TagAdminController::class);
    Route::resource('contact-requests', ContactRequestAdminController::class)
        ->only(['index', 'destroy']);
    Route::resource('media', MediaAdminController::class)->only(['index', 'store']);
    Route::delete('media', [MediaAdminController::class, 'destroy'])->name('media.destroy');
    Route::get('settings', [SettingsAdminController::class, 'index'])->name('settings.index');
    Route::post('/generate-sitemap', [SettingsAdminController::class, 'generateSitemap'])
        ->name('settings.generate-sitemap');
    Route::put('/update-heatmap', [SettingsAdminController::class, 'updateHeatmap'])
        ->name('settings.update-heatmap');


    Route::get('/google-auth', [GoogleAuthController::class, 'callback'])->name('google-auth.callback');
});
