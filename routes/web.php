<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register'); // Show the registration form
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store'); // Handle the registration form submission
    Route::get('/login', [LoginController::class, 'show'])->name('login'); // Show the login form
    Route::post('/login', [LoginController::class, 'store'])->name('login.store'); // Handle the login form submission

});

// Protected tenant routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Product routes
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

    // Category routes
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

    // Unit routes
    Route::get('/units', [App\Http\Controllers\UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [App\Http\Controllers\UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [App\Http\Controllers\UnitController::class, 'store'])->name('units.store');

    // Settings routes
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'show'])->name('settings');
    Route::put('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
});
