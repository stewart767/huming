<?php

use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\HomepageController as AdminHomepageController;
use App\Http\Controllers\Admin\ManufacturingProcessController as AdminManufacturingProcessController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController as AdminProductImageController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ApplicationController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ManufacturingController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\QuoteController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/manufacturing', [ManufacturingController::class, 'index'])->name('manufacturing');
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::get('/applications/{slug}', [ApplicationController::class, 'show'])->name('applications.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/quote', [QuoteController::class, 'create'])->name('quote.create');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/quote/success/{quote_number}', [QuoteController::class, 'success'])->name('quote.success');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products Management
    Route::resource('products', AdminProductController::class);
    Route::post('/products/{product}/toggle-featured', [AdminProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    Route::post('/products/{product}/images', [AdminProductImageController::class, 'store'])->name('products.images.store');
    Route::delete('/product-images/{image}', [AdminProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::post('/product-images/{image}/set-primary', [AdminProductImageController::class, 'setPrimary'])->name('products.images.set-primary');

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Applications
    Route::resource('applications', AdminApplicationController::class);

    // Quotation Requests
    Route::get('/quotes', [AdminQuoteRequestController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/{quote}', [AdminQuoteRequestController::class, 'show'])->name('quotes.show');
    Route::put('/quotes/{quote}', [AdminQuoteRequestController::class, 'update'])->name('quotes.update');
    Route::delete('/quotes/{quote}', [AdminQuoteRequestController::class, 'destroy'])->name('quotes.destroy');
    Route::get('/quotes/{quote}/attachment', [AdminQuoteRequestController::class, 'downloadAttachment'])->name('quotes.download');

    // Contact Messages
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::put('/messages/{message}', [AdminContactMessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

    // Gallery Management
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::post('/gallery-categories', [AdminGalleryController::class, 'storeCategory'])->name('gallery.categories.store');

    // Homepage CMS
    Route::get('/homepage', [AdminHomepageController::class, 'index'])->name('homepage.index');
    Route::post('/homepage/slides', [AdminHomepageController::class, 'storeSlide'])->name('homepage.slides.store');
    Route::put('/homepage/slides/{slide}', [AdminHomepageController::class, 'updateSlide'])->name('homepage.slides.update');
    Route::delete('/homepage/slides/{slide}', [AdminHomepageController::class, 'destroySlide'])->name('homepage.slides.destroy');
    Route::post('/homepage/features', [AdminHomepageController::class, 'storeFeature'])->name('homepage.features.store');
    Route::put('/homepage/features/{feature}', [AdminHomepageController::class, 'updateFeature'])->name('homepage.features.update');
    Route::delete('/homepage/features/{feature}', [AdminHomepageController::class, 'destroyFeature'])->name('homepage.features.destroy');

    // Manufacturing Process & Values CMS
    Route::get('/manufacturing-cms', [AdminManufacturingProcessController::class, 'index'])->name('manufacturing.index');
    Route::post('/manufacturing-cms/processes', [AdminManufacturingProcessController::class, 'storeProcess'])->name('manufacturing.processes.store');
    Route::put('/manufacturing-cms/processes/{process}', [AdminManufacturingProcessController::class, 'updateProcess'])->name('manufacturing.processes.update');
    Route::delete('/manufacturing-cms/processes/{process}', [AdminManufacturingProcessController::class, 'destroyProcess'])->name('manufacturing.processes.destroy');
    Route::post('/manufacturing-cms/values', [AdminManufacturingProcessController::class, 'storeValue'])->name('manufacturing.values.store');
    Route::put('/manufacturing-cms/values/{value}', [AdminManufacturingProcessController::class, 'updateValue'])->name('manufacturing.values.update');
    Route::delete('/manufacturing-cms/values/{value}', [AdminManufacturingProcessController::class, 'destroyValue'])->name('manufacturing.values.destroy');

    // Company Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Staff Users (Super Admin)
    Route::resource('users', AdminUserController::class)->except(['create', 'show', 'edit']);
});
