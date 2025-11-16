<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\Admin\RegisterAdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FlutterPaymentController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [ProductsController::class, 'index'])->name('store.index');
Route::get('/store/{product:name}', [ProductsController::class, 'show'])->name('store.show');
Route::get('/search', ProductsController::class)->name('search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{name}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('email', [EmailsController::class, 'sendEmail']);

Route::middleware('auth')->group(
    function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'processAndPay'])->name('checkout.process');
        // Route::get('/pay', [PaymentController::class, 'pay'])->name('payment.page');
        Route::get('/pay', [PaymentController::class, 'processPayment'])->name('payment.process');
        Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
        Route::get('/payment/success/{order}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::any('/flutter/pay', [FlutterPaymentController::class, 'pay_with_flutter'])->name('flutter_payment.page');
        Route::post('verify-flutter_payment', [FlutterPaymentController::class, 'verifyPayment'])->name('flutter_payment.verify');
        Route::get('/payment/success/{reference}', [FlutterPaymentController::class, 'showPaymentDetails'])
            ->name('flutter_payment.success');

        Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    }
);

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/signin', [AdminSessionController::class, 'showSignin'])->name('signin');
    Route::post('/signin', [AdminSessionController::class, 'storeSignin'])->name('store.signin');
    Route::get('/signup', [RegisterAdminController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [RegisterAdminController::class, 'storeSignup'])->name('store.signup');
});
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/manage_products', [DashboardController::class, 'showManageProducts'])->name('manage.products');
    Route::get('/search_products', [DashboardController::class, 'searchProducts'])->name('search.products');
    Route::get('/add_new_products', [DashboardController::class, 'showAddProducts'])->name('add.products');
    Route::post('/add_new_products', [DashboardController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/update_product/{id}', [DashboardController::class, 'showUpdateProduct'])->name('update.product');
    Route::post('/update_product/{id}', [DashboardController::class, 'updateProduct'])->name('storeupdate.product');
    
    Route::get('/add_brand', [DashboardController::class, 'showBrands'])->name('add.brand');
    Route::get('/billing', [DashboardController::class, 'showBilling'])->name('billing');
    Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile');
    Route::get('/customer_orders', [DashboardController::class, 'showCustomerOrders'])->name('customer.orders');
    Route::get('/customer_orders/search', [DashboardController::class, 'searchOrdersByID'])->name('customer.orders.search');
    Route::get('/customer_details/{user_id}', [DashboardController::class, 'showCustomerDetails'])->name('customer.details');
    Route::get('/settings', [DashboardController::class, 'showSettings'])->name('settings');
    Route::post('/logout', [AdminSessionController::class, 'destroy'])->name('admin.logout');
});

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [SessionController::class, 'storeLogin'])->name('login.post');
    Route::get('/register', [RegisterUserController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'storeRegister'])->name('register.post');
});
