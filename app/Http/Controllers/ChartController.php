<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ChartController extends Controller
{
    public function getStockLevels()
    {
        $products = Product::select('name', 'quantity', 'minimum_stock')
            ->orderBy('quantity', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            'labels' => $products->pluck('name'),
            'current' => $products->pluck('quantity'),
            'minimum' => $products->pluck('minimum_stock'),
        ]);
    }
}