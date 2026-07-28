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
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
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

    // Stock routes
    Route::get('/stock', [App\Http\Controllers\StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/add', [App\Http\Controllers\StockController::class, 'add'])->name('stock.add');
    Route::post('/stock/add', [App\Http\Controllers\StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/movements', [App\Http\Controllers\StockController::class, 'movements'])->name('stock.movements');

    // Location routes
    Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [App\Http\Controllers\LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [App\Http\Controllers\LocationController::class, 'store'])->name('locations.store');

    // Supplier routes
    Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [App\Http\Controllers\SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [App\Http\Controllers\SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}/edit', [App\Http\Controllers\SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [App\Http\Controllers\SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Purchase Order routes
    Route::get('/purchase-orders', [App\Http\Controllers\PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
    Route::get('/purchase-orders/create', [App\Http\Controllers\PurchaseOrderController::class, 'create'])->name('purchase-orders.create');
    Route::post('/purchase-orders', [App\Http\Controllers\PurchaseOrderController::class, 'store'])->name('purchase-orders.store');
    Route::get('/purchase-orders/{purchaseOrder}', [App\Http\Controllers\PurchaseOrderController::class, 'show'])->name('purchase-orders.show');
    Route::put('/purchase-orders/{purchaseOrder}/receive', [App\Http\Controllers\PurchaseOrderController::class, 'receive'])->name('purchase-orders.receive');

    // Customer routes
    Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');

    // Sales Order routes
    Route::get('/sales-orders', [App\Http\Controllers\SalesOrderController::class, 'index'])->name('sales-orders.index');
    Route::get('/sales-orders/create', [App\Http\Controllers\SalesOrderController::class, 'create'])->name('sales-orders.create');
    Route::post('/sales-orders', [App\Http\Controllers\SalesOrderController::class, 'store'])->name('sales-orders.store');
    Route::get('/sales-orders/{salesOrder}', [App\Http\Controllers\SalesOrderController::class, 'show'])->name('sales-orders.show');
    Route::put('/sales-orders/{salesOrder}/confirm', [App\Http\Controllers\SalesOrderController::class, 'confirm'])->name('sales-orders.confirm');

    // Invoice routes
    Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoices.show');
    Route::post('/invoices/{invoice}/pay', [App\Http\Controllers\InvoiceController::class, 'pay'])->name('invoices.pay');
    });
