<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\EmailsController;

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
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    }
);

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [SessionController::class, 'storeLogin'])->name('login.post');
    Route::get('/register', [RegisterUserController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'storeRegister'])->name('register.post');
});
