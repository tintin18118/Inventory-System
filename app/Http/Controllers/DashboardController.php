<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Dashboard statistics
            $totalProducts = Product::count();
            $lowStockProducts = Product::whereColumn('quantity', '<=', 'minimum_stock')->count();
            $totalSuppliers = Supplier::count();
            
            // Recent stock movements
            $recentStockMovements = StockHistory::with(['product', 'user'])
                ->latest()
                ->limit(10)
                ->get();

            // Low stock products
            $lowStockItems = Product::with('supplier')
                ->whereColumn('quantity', '<=', 'minimum_stock')
                ->orderBy('quantity', 'asc')
                ->limit(5)
                ->get();

            return view('dashboard.index', compact(
                'totalProducts',
                'lowStockProducts',
                'totalSuppliers',
                'recentStockMovements',
                'lowStockItems'
            ));
        } catch (\Exception $e) {
            return view('dashboard.index', [
                'totalProducts' => 0,
                'lowStockProducts' => 0,
                'totalSuppliers' => 0,
                'recentStockMovements' => collect(),
                'lowStockItems' => collect()
            ]);
        }
    }
}
