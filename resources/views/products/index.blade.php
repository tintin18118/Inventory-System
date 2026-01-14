@extends('layouts.app')

@section('content')
<div class="grid gap-6">
    <div class="flex-between">
        <h2>Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Add Product
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
                <div style="flex: 1;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or SKU..." 
                        class="form-control">
                </div>
                <div style="width: 250px;">
                    <select name="supplier_id" class="form-control">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    Filter
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    Clear
                </a>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: var(--text-primary);">{{ $product->name }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">{{ Str::limit($product->description, 40) }}</div>
                    </td>
                    <td style="font-family: monospace; font-weight: 600;">{{ $product->sku }}</td>
                    <td>{{ $product->supplier->name }}</td>
                    <td style="font-weight: 600; color: var(--deep-yellow);">${{ number_format($product->price, 2) }}</td>
                    <td style="font-weight: 700; font-size: 1.125rem;">{{ $product->quantity }}</td>
                    <td>
                        @if($product->isLowStock())
                            <span class="badge badge-danger">Low Stock</span>
                        @else
                            <span class="badge badge-success">In Stock</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 3rem;">
                        <div style="color: var(--text-muted);">
                            <svg style="width: 64px; height: 64px; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p>No products found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($products->onFirstPage())
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Previous</span>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="pagination-item">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <span class="pagination-item active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="pagination-item">Next</a>
        @else
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Next</span>
        @endif
    </div>
    @endif
</div>
@endsection