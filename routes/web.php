<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MarketerController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Home
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Public search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Auth required
Route::middleware(['auth'])->group(function () {
    // User inquiries
    Route::post('/inquiries/{marketer}', [InquiryController::class, 'store'])->name('inquiries.store');

    // Marketer routes
    // Route::middleware(['auth', 'isMarketer'])->group(function () {
    //     Route::get('/marketer/dashboard', [MarketerController::class, 'dashboard'])->name('marketer.dashboard');
    //     Route::post('/marketer/profile', [MarketerController::class, 'updateProfile'])->name('marketer.profile.update');
    //     Route::get('/marketer/products', [MarketerController::class, 'manageProducts'])->name('marketer.products.manage');
    //     Route::post('/marketer/products', [MarketerController::class, 'attachProduct'])->name('marketer.products.attach');
    //     Route::get('/marketer/inquiries', [InquiryController::class, 'marketerInquiries'])->name('marketer.inquiries');
    //      Route::get('/products', [MarketerController::class, 'allProducts'])->name('products.all');
    // });

    // Admin routes
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
        Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
        Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    });

    Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);



Route::middleware(['auth', 'isMarketer'])->group(function () {
    Route::get('/marketer/dashboard', [MarketerController::class, 'dashboard'])->name('marketer.dashboard');
    Route::get('/marketer/profile/edit/{profile}', [MarketerController::class, 'editProfile'])->name('marketer.profile.edit');
    Route::put('/marketer/profile', [MarketerController::class, 'updateProfile'])->name('marketer.profile.update');
    Route::get('/marketer/products/manage', [MarketerController::class, 'manageProducts'])->name('marketer.products.manage');
    Route::post('/marketer/products', [MarketerController::class, 'attachProduct'])->name('marketer.products.attach');
    Route::put('/marketer/products/{product}', [MarketerController::class, 'updateProduct'])->name('marketer.products.update');
    Route::delete('/marketer/products/{product}', [MarketerController::class, 'deleteProduct'])->name('marketer.products.delete');
    Route::get('/marketer/inquiries', [MarketerController::class, 'inquiries'])->name('marketer.inquiries');
    Route::get('/marketer/products/all', [MarketerController::class, 'allProducts'])->name('marketer.products.all');
    Route::get('/marketer/products/edit/{product}', [MarketerController::class, 'editProduct'])->name('marketer.products.edit');
    Route::get('/marketer/products/search', [MarketerController::class, 'search'])->name('marketer.products.search');
});

Route::get('/marketer/profile/{userid}', [MarketerController::class, 'showProfile'])->name('marketer.profile.show');

