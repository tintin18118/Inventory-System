@extends('layouts.app')

@section('content')
<div class="grid gap-6">
    <div>
        <h2>Dashboard</h2>
        <p class="text-muted">Welcome to Inventory Management System</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-3 gap-6">
        <div class="card">
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: var(--primary); color: white; padding: 1rem; border-radius: 8px;">
                        <svg width="32" height="32" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">Total Products</div>
                        <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary);">
                            {{ isset($totalProducts) ? $totalProducts : 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                        <svg width="32" height="32" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">Low Stock Items</div>
                        <div style="font-size: 2rem; font-weight: 700; color: var(--danger);">
                            {{ isset($lowStockProducts) ? $lowStockProducts : 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: var(--success); color: white; padding: 1rem; border-radius: 8px;">
                        <svg width="32" height="32" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">Suppliers</div>
                        <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary);">
                            {{ isset($totalSuppliers) ? $totalSuppliers : 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="card-body">
            <div class="flex gap-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Add Product
                </a>
                <a href="{{ route('stock.in') }}" class="btn btn-success">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Stock In
                </a>
                <a href="{{ route('stock.out') }}" class="btn btn-danger">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Stock Out
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    @if(isset($lowStockItems) && $lowStockItems->count() > 0)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Low Stock Alert</h3>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Supplier</th>
                            <th>Current Stock</th>
                            <th>Minimum Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockItems as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><code>{{ $item->sku }}</code></td>
                            <td>{{ optional($item->supplier)->name ?? 'N/A' }}</td>
                            <td class="text-danger"><strong>{{ $item->quantity }}</strong></td>
                            <td>{{ $item->minimum_stock }}</td>
                            <td>
                                <a href="{{ route('stock.in') }}" class="btn btn-success btn-sm">Restock</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Stock Movements -->
    <div class="card">
        <div class="card-header">
            <div class="flex-between">
                <h3 class="card-title">Recent Stock Movements</h3>
                <a href="{{ route('stock.history') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($recentStockMovements) && $recentStockMovements->count() > 0)
                            @foreach($recentStockMovements as $movement)
                            <tr>
                                <td>{{ $movement->created_at->format('M d, H:i') }}</td>
                                <td>{{ $movement->product->name }}</td>
                                <td>
                                    <span class="badge {{ $movement->type == 'in' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $movement->type == 'in' ? 'Stock In' : 'Stock Out' }}
                                    </span>
                                </td>
                                <td class="{{ $movement->type == 'in' ? 'text-success' : 'text-danger' }}">
                                    <strong>{{ $movement->type == 'in' ? '+' : '-' }}{{ $movement->quantity }}</strong>
                                </td>
                                <td>{{ optional($movement->user)->name ?? 'System' }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 2rem; color: var(--text-muted);">
                                No recent stock movements
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection