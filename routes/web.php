<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ProductsController;

Route::get('/', [ProductsController::class, 'index'])->name('store.index');
Route::get('/store/{slug}', [ProductsController::class, 'show'])->name('store.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{slug}', [CartController::class, 'remove'])->name('cart.remove');

route::middleware('auth')->group(
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
