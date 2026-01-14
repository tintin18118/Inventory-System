<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chart/stock-levels', [ChartController::class, 'getStockLevels']);
});