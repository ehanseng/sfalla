<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CoachingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryPageController; // Import the new controller
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\TimelineEventController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\HeroBannerSettingController; // Import the new controller
use Spatie\Sitemap\SitemapGenerator;
use App\Models\Post;

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

// Frontend Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/coaching', [CoachingController::class, 'index'])->name('coaching');
Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');

// Dynamic Category Pages Route
Route::get('/seccion/{slug}', [CategoryPageController::class, 'show'])->name('category.show');

// Generic Post Route
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Sitemap Generator
Route::get('/sitemap', function () {
    SitemapGenerator::create(config('app.url'))
        ->add(Post::all())
        ->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap created!';
});

// Breeze Dashboard (Default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('timeline-events', TimelineEventController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('menu-items', MenuItemController::class);
    
    // Hero Banner Settings Routes
    Route::get('hero-banner', [HeroBannerSettingController::class, 'edit'])->name('hero-banner.edit');
    Route::put('hero-banner', [HeroBannerSettingController::class, 'update'])->name('hero-banner.update');
});

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
