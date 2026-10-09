<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Public Landing Page & Consultation
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/consultation', [HomeController::class, 'storeLead'])->name('consultation.store');

// Public Editorial & Blog Routes (AdSense E-E-A-T & Multi-page Architecture)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/privacy-policy', [BlogController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-service', [BlogController::class, 'termsOfService'])->name('terms.service');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin CMS Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Services & Portfolios (Software House)
    Route::resource('services', ServiceController::class);
    Route::resource('portfolios', PortfolioController::class);

    // Pages & Dynamic Sections
    Route::resource('pages', PageController::class);
    Route::put('pages/{page}/sections/{section}', [PageController::class, 'updateSection'])->name('pages.sections.update');

    // Posts & Categories (Knowledge Base / Articles)
    Route::resource('posts', PostController::class);
    Route::post('categories', [PostController::class, 'storeCategory'])->name('categories.store');
    Route::delete('categories/{category}', [PostController::class, 'destroyCategory'])->name('categories.destroy');
});

require __DIR__.'/auth.php';
