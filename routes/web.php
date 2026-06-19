<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

// Marketplace Routes
Route::get('/', [\App\Http\Controllers\MarketplaceController::class, 'index'])->name('landing');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

Route::get('/store', [\App\Http\Controllers\CatalogController::class, 'index'])->name('store.index');
Route::get('/store/{slug}', [\App\Http\Controllers\CatalogController::class, 'show'])->name('catalog.show');

Route::get('/products', [\App\Http\Controllers\ProductCatalogController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [\App\Http\Controllers\ProductCatalogController::class, 'show'])->name('products.show');

// Blog & Artikel
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Cart Routes (Customer)
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout Routes (Customer)
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->middleware('throttle:checkout')->name('checkout.process');
    Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

    // Order Tracking Routes (Customer)
    Route::get('/customer/orders', [\App\Http\Controllers\CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/customer/orders/{order}', [\App\Http\Controllers\CustomerOrderController::class, 'show'])->name('customer.orders.show');
    Route::post('/customer/orders/{order}/cancel', [\App\Http\Controllers\CustomerOrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::post('/customer/orders/{order}/complete', [\App\Http\Controllers\CustomerOrderController::class, 'complete'])->name('customer.orders.complete');
    Route::get('/customer/orders/{order}/invoice', [\App\Http\Controllers\CustomerOrderController::class, 'invoice'])->name('customer.orders.invoice');

    // Review Routes (Customer)
    Route::post('/customer/orders/{order}/review-product', [\App\Http\Controllers\ReviewController::class, 'storeProductReview'])->name('customer.reviews.product');
    Route::post('/customer/orders/{order}/review-store', [\App\Http\Controllers\ReviewController::class, 'storeStoreReview'])->name('customer.reviews.store');

    // Dashboard - accessible by all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard/products')->name('dashboard.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('dashboard/orders')->name('dashboard.orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\StoreOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [\App\Http\Controllers\StoreOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [\App\Http\Controllers\StoreOrderController::class, 'updateStatus'])->name('update_status');
    });

    Route::prefix('dashboard/reviews')->name('dashboard.reviews.')->group(function () {
        Route::get('/', [\App\Http\Controllers\StoreReviewController::class, 'index'])->name('index');
    });

    // Store Creation (For 'user' role)
    Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');

    // Owner-only routes
    Route::middleware('role:owner')->group(function () {
        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/pdf', [\App\Http\Controllers\ReportController::class, 'exportPdf'])->name('reports.pdf');
        
        // Store Profile
        Route::get('/stores/edit', [StoreController::class, 'edit'])->name('stores.edit');
        Route::put('/stores', [StoreController::class, 'update'])->name('stores.update');

        // Staff Management
        Route::resource('staff', StaffController::class)->except(['show', 'edit', 'update']);

        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });

    // Owner + Cashier routes (both can access)
    Route::middleware('role:owner,cashier')->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
    });

    Route::middleware('role:owner,cashier')->group(function () {
        // Transactions
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions/parse', [TransactionController::class, 'parseChat'])->name('transactions.parse');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    });

    // Customer Routes
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\CustomerDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [\App\Http\Controllers\CustomerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\CustomerProfileController::class, 'update'])->name('profile.update');
        
        Route::resource('address', \App\Http\Controllers\CustomerAddressController::class)->except(['show']);
    });

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/stores', [\App\Http\Controllers\Admin\StoreController::class, 'index'])->name('stores.index');
        Route::post('/stores/{store}/suspend', [\App\Http\Controllers\Admin\StoreController::class, 'suspend'])->name('stores.suspend');
        Route::post('/stores/{store}/unsuspend', [\App\Http\Controllers\Admin\StoreController::class, 'unsuspend'])->name('stores.unsuspend');
        
        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
        Route::post('/products/{product}/suspend', [\App\Http\Controllers\Admin\ProductController::class, 'suspend'])->name('products.suspend');
        Route::post('/products/{product}/unsuspend', [\App\Http\Controllers\Admin\ProductController::class, 'unsuspend'])->name('products.unsuspend');
        
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
