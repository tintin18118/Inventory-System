<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home/Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Product Routes
Route::resource('products', ProductController::class);

// Supplier Routes
Route::resource('suppliers', SupplierController::class);

// Stock Management Routes
Route::prefix('stock')->name('stock.')->group(function () {
    // Stock In
    Route::get('in', [StockController::class, 'in'])->name('in');
    Route::post('in', [StockController::class, 'storeIn'])->name('in.store');
    
    // Stock Out
    Route::get('out', [StockController::class, 'out'])->name('out');
    Route::post('out', [StockController::class, 'storeOut'])->name('out.store');
    
    // History
    Route::get('history', [StockController::class, 'history'])->name('history');
});
