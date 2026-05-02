<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/catalog'))->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:customer')->group(function (): void {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
        Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/orders/{order}/proof', [OrderController::class, 'uploadProof'])->name('orders.proof');

        Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    });

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    Route::middleware('role:admin')->group(function (): void {
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
        Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
    });

    Route::middleware('role:admin')->group(function (): void {
        Route::resource('products', ProductController::class);
        Route::get('/admin/reports', [DashboardController::class, 'reports'])->name('admin.reports');
        Route::get('/admin/reports/download', [DashboardController::class, 'downloadReport'])->name('admin.reports.download');
    });
});
