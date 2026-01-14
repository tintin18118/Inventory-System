<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function in()
    {
        $products = Product::orderBy('name')->get();
        return view('stock.in', compact('products'));
    }

    public function storeIn(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            DB::transaction(function() use ($validated) {
                $product = Product::findOrFail($validated['product_id']);
                
                // Update product quantity
                $product->increment('quantity', $validated['quantity']);

                // Create stock history record
                StockHistory::create([
                    'product_id' => $validated['product_id'],
                    'type' => 'in',
                    'quantity' => $validated['quantity'],
                    'notes' => $validated['notes'] ?? null,
                    'user_id' => Auth::id()
                ]);
            });

            return redirect()->route('stock.in')
                ->with('success', 'Stock added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add stock: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function out()
    {
        $products = Product::where('quantity', '>', 0)->orderBy('name')->get();
        return view('stock.out', compact('products'));
    }

    public function storeOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            DB::transaction(function() use ($validated) {
                $product = Product::findOrFail($validated['product_id']);
                
                // Check if sufficient quantity available
                if ($product->quantity < $validated['quantity']) {
                    throw new \Exception('Insufficient stock available. Current quantity: ' . $product->quantity);
                }

                // Update product quantity
                $product->decrement('quantity', $validated['quantity']);

                // Create stock history record
                StockHistory::create([
                    'product_id' => $validated['product_id'],
                    'type' => 'out',
                    'quantity' => $validated['quantity'],
                    'notes' => $validated['notes'] ?? null,
                    'user_id' => Auth::id()
                ]);
            });

            return redirect()->route('stock.out')
                ->with('success', 'Stock removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function history()
    {
        $histories = StockHistory::with(['product', 'user'])
            ->latest()
            ->paginate(20);

        return view('stock.history', compact('histories'));
    }
}
