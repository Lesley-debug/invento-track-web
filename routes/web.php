<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    $plans = \App\Models\Plan::where('is_active', true)
        ->orderBy('price_monthly')
        ->get();
    return view('welcome', compact('plans'));
});

Route::get('/privacy-policy', function () {
    return view('legal.privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');
Route::get('/cookies', function () {
    return view('legal.cookies');
})->name('cookies');

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

    // Category edit/delete
    Route::get('/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

    // Unit edit/delete
    Route::get('/units/{unit}/edit', [App\Http\Controllers\UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}', [App\Http\Controllers\UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [App\Http\Controllers\UnitController::class, 'destroy'])->name('units.destroy');

    // Customer edit/delete
    Route::get('/customers/{customer}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');

    // Location edit/delete
    Route::get('/locations/{location}/edit', [App\Http\Controllers\LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{location}', [App\Http\Controllers\LocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{location}', [App\Http\Controllers\LocationController::class, 'destroy'])->name('locations.destroy');

    // Security settings
    Route::get('/settings/security', [App\Http\Controllers\SettingsController::class, 'security'])->name('settings.security');
    Route::put('/settings/security', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');


// SEO landing pages
Route::get('/for/{slug}', function ($slug) {
    $pages = [
        'pharmacies' => [
            'title' => 'Pharmacy Inventory Management Software',
            'hero' => 'Built for Pharmacies',
            'subtitle' => 'Track medicine stock, manage expiry dates, issue prescriptions and invoices — all from one dashboard.',
            'keywords' => 'pharmacy inventory management software Africa, medicine stock tracking, pharmacy software Nigeria Ghana Kenya Cameroon',
            'features' => [
                'Expiry date tracking for all medicines',
                'Low stock alerts before you run out',
                'Supplier purchase orders',
                'Patient invoicing and payments',
                'Multi-branch pharmacy support',
                'Role-based staff access',
            ],
            'color' => 'emerald',
            'emoji' => '💊',
        ],
        'uk' => [
            'title' => 'Inventory Management Software UK',
            'hero' => 'Built for UK Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue invoices in GBP. The inventory system built for United Kingdom businesses.',
            'keywords' => 'inventory management software UK, stock management system United Kingdom, inventory software London Birmingham Manchester',
            'features' => [
                'British Pound (GBP) support',
                'VAT-ready invoicing',
                'Multi-location warehouse tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'blue',
            'emoji' => '🇬🇧',
        ],
        'usa' => [
            'title' => 'Inventory Management Software USA',
            'hero' => 'Built for US Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue invoices in USD. The inventory system built for American businesses.',
            'keywords' => 'inventory management software USA, stock management system United States, inventory software New York Los Angeles Chicago',
            'features' => [
                'US Dollar (USD) support',
                'Tax-ready invoicing',
                'Multi-warehouse tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'red',
            'emoji' => '🇺🇸',
        ],
        'canada' => [
            'title' => 'Inventory Management Software Canada',
            'hero' => 'Built for Canadian Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue invoices in CAD. The inventory system built for Canadian businesses.',
            'keywords' => 'inventory management software Canada, stock management system Canada, inventory software Toronto Vancouver Montreal',
            'features' => [
                'Canadian Dollar (CAD) support',
                'GST/HST ready invoicing',
                'Multi-location tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'red',
            'emoji' => '🇨🇦',
        ],
        'india' => [
            'title' => 'Inventory Management Software India',
            'hero' => 'Built for Indian Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue GST invoices in INR. The inventory system built for Indian businesses.',
            'keywords' => 'inventory management software India, stock management system India, inventory software Mumbai Delhi Bangalore',
            'features' => [
                'Indian Rupee (INR) support',
                'GST-ready invoicing',
                'Multi-warehouse tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'orange',
            'emoji' => '🇮🇳',
        ],
        'france' => [
            'title' => 'Logiciel de Gestion des Stocks France',
            'hero' => 'Built for French Businesses',
            'subtitle' => 'Gérez vos stocks, commandes et factures en EUR. Le logiciel de gestion des stocks pour les entreprises françaises.',
            'keywords' => 'logiciel gestion stock France, inventory management software France, gestion inventaire Paris Lyon Marseille',
            'features' => [
                'Euro (EUR) support',
                'TVA-ready invoicing',
                'Multi-warehouse tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'blue',
            'emoji' => '🇫🇷',
        ],
        'australia' => [
            'title' => 'Inventory Management Software Australia',
            'hero' => 'Built for Australian Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue invoices in AUD. The inventory system built for Australian businesses.',
            'keywords' => 'inventory management software Australia, stock management system Australia, inventory software Sydney Melbourne Brisbane',
            'features' => [
                'Australian Dollar (AUD) support',
                'GST-ready invoicing',
                'Multi-location tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'yellow',
            'emoji' => '🇦🇺',
        ],
        'uae' => [
            'title' => 'Inventory Management Software UAE',
            'hero' => 'Built for UAE Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue VAT invoices in AED. The inventory system built for UAE businesses.',
            'keywords' => 'inventory management software UAE, stock management system Dubai, inventory software Abu Dhabi Sharjah',
            'features' => [
                'UAE Dirham (AED) support',
                'VAT-ready invoicing',
                'Multi-warehouse tracking',
                'Supplier purchase orders',
                'Customer management',
                'Free 14-day trial',
            ],
            'color' => 'emerald',
            'emoji' => '🇦🇪',
        ],
        'restaurants' => [
            'title' => 'Restaurant Inventory Management Software',
            'hero' => 'Built for Restaurants',
            'subtitle' => 'Track ingredients, manage food suppliers, reduce waste and control costs — all from one dashboard.',
            'keywords' => 'restaurant inventory management software, food inventory tracking, restaurant stock management Africa',
            'features' => [
                'Ingredient and food stock tracking',
                'Expiry date alerts for perishables',
                'Supplier purchase orders',
                'Waste reduction tracking',
                'Multi-branch support',
                'Staff access control',
            ],
            'color' => 'orange',
            'emoji' => '🍽️',
        ],
        'warehouses' => [
            'title' => 'Warehouse Management System',
            'hero' => 'Built for Warehouses',
            'subtitle' => 'Manage stock across multiple warehouse locations, track movements and optimize your storage operations.',
            'keywords' => 'warehouse management system Africa, warehouse inventory software, stock management warehouse Nigeria Ghana Kenya',
            'features' => [
                'Multi-location warehouse tracking',
                'Stock movement audit trail',
                'Purchase orders from suppliers',
                'Low stock alerts',
                'Barcode and SKU management',
                'Team access control',
            ],
            'color' => 'gray',
            'emoji' => '🏭',
        ],
        'clinics' => [
            'title' => 'Clinic Inventory Management Software',
            'hero' => 'Built for Clinics',
            'subtitle' => 'Track medical supplies, medicines and equipment across your clinic with full compliance audit trails.',
            'keywords' => 'clinic inventory management software Africa, medical clinic stock tracking, clinic inventory system Nigeria Ghana Kenya Cameroon',
            'features' => [
                'Medicine and supply tracking',
                'Expiry date alerts',
                'Equipment inventory management',
                'Supplier purchase orders',
                'Patient invoicing',
                'Full audit trail for compliance',
            ],
            'color' => 'teal',
            'emoji' => '🏨',
        ],
        'supermarkets' => [
            'title' => 'Supermarket Stock Management System',
            'hero' => 'Built for Supermarkets',
            'subtitle' => 'Manage thousands of products, track stock across multiple locations, and never run out of fast-moving items.',
            'keywords' => 'supermarket inventory management software Africa, stock management system, retail inventory Nigeria Ghana Kenya',
            'features' => [
                'Manage thousands of products with ease',
                'Multi-location stock tracking',
                'Barcode and SKU management',
                'Supplier purchase orders',
                'Sales orders and invoicing',
                'Low stock alerts',
            ],
            'color' => 'blue',
            'emoji' => '🏪',
        ],
        'hospitals' => [
            'title' => 'Hospital Inventory Management Software',
            'hero' => 'Built for Hospitals',
            'subtitle' => 'Track medical supplies, equipment, and medicines across all departments with complete audit trails.',
            'keywords' => 'hospital inventory management software Africa, medical supply tracking, hospital stock system Nigeria Ghana Kenya Cameroon',
            'features' => [
                'Medical supply tracking by department',
                'Equipment inventory management',
                'Expiry date alerts for medicines',
                'Full audit trail for compliance',
                'Purchase orders from medical suppliers',
                'Multi-department access control',
            ],
            'color' => 'red',
            'emoji' => '🏥',
        ],
        'nigeria' => [
            'title' => 'Inventory Management Software Nigeria',
            'hero' => 'Built for Nigerian Businesses',
            'subtitle' => 'Track stock, manage purchase orders and issue invoices in NGN. The inventory system built for Nigeria.',
            'keywords' => 'inventory management software Nigeria, stock management system Nigeria, inventory software Lagos Abuja Kano',
            'features' => [
                'Nigerian Naira (NGN) support',
                'Works across all Nigerian states',
                'Mobile-friendly for field teams',
                'Low internet mode support',
                'Local supplier management',
                'Multi-branch business support',
            ],
            'color' => 'green',
            'emoji' => '🇳🇬',
        ],
        'ghana' => [
            'title' => 'Inventory Management Software Ghana',
            'hero' => 'Built for Ghanaian Businesses',
            'subtitle' => 'Manage your stock, purchase orders and invoices in GHS. The inventory system built for Ghana.',
            'keywords' => 'inventory management software Ghana, stock management system Ghana, inventory software Accra Kumasi',
            'features' => [
                'Ghanaian Cedi (GHS) support',
                'Works across all Ghanaian regions',
                'Mobile-friendly dashboard',
                'Supplier and customer management',
                'Purchase orders and invoicing',
                'Free 14-day trial',
            ],
            'color' => 'yellow',
            'emoji' => '🇬🇭',
        ],
        'kenya' => [
            'title' => 'Inventory Management Software Kenya',
            'hero' => 'Built for Kenyan Businesses',
            'subtitle' => 'Track stock, manage M-Pesa payments and issue invoices in KES. The inventory system built for Kenya.',
            'keywords' => 'inventory management software Kenya, stock management system Kenya, inventory software Nairobi Mombasa',
            'features' => [
                'Kenyan Shilling (KES) support',
                'Mobile money payment tracking',
                'Works across all Kenyan counties',
                'Supplier and customer management',
                'Purchase orders and invoicing',
                'Free 14-day trial',
            ],
            'color' => 'red',
            'emoji' => '🇰🇪',
        ],
        'cameroon' => [
            'title' => 'Logiciel de Gestion de Stock Cameroun',
            'hero' => 'Built for Cameroonian Businesses',
            'subtitle' => 'Gérez votre stock, vos commandes et vos factures en XAF. Le système de gestion d\'inventaire fait pour le Cameroun.',
            'keywords' => 'logiciel gestion stock Cameroun, inventory management software Cameroon, gestion inventaire Douala Yaounde Bamenda',
            'features' => [
                'Franc CFA (XAF) support',
                'French and English interface',
                'Works across all Cameroonian regions',
                'Supplier management',
                'Invoicing and payments',
                'Free 14-day trial',
            ],
            'color' => 'indigo',
            'emoji' => '🇨🇲',
        ],
        'retail' => [
            'title' => 'Retail Inventory Management Software Africa',
            'hero' => 'Built for Retail Shops',
            'subtitle' => 'Manage your retail shop inventory, track sales, issue receipts and never run out of stock.',
            'keywords' => 'retail inventory management software Africa, retail stock management, shop inventory system Nigeria Ghana Kenya',
            'features' => [
                'Product catalogue management',
                'Sales tracking and reporting',
                'Customer receipts and invoices',
                'Low stock alerts',
                'Supplier purchase orders',
                'Multi-staff access',
            ],
            'color' => 'violet',
            'emoji' => '🛒',
        ],
    ];

    if (!isset($pages[$slug])) {
        abort(404);
    }

    $page = $pages[$slug];
    return view('seo.landing', compact('page', 'slug'));
})->name('seo.landing');