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
    Route::get('/signup', [RegisterAdminController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [RegisterAdminController::class, 'storeSignup'])->name('store.signup');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/table', [DashboardController::class, 'showTable'])->name('table');
    Route::get('/billing', [DashboardController::class, 'showBilling'])->name('billing');
    Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile');
});

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [SessionController::class, 'storeLogin'])->name('login.post');
    Route::get('/register', [RegisterUserController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'storeRegister'])->name('register.post');
});
