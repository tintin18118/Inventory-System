@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div class="grid gap-6">
        <div>
            <h2>Stock Out</h2>
            <p class="text-muted">Remove inventory from products</p>
        </div>

        <div class="flex gap-2" style="border-bottom: 2px solid var(--border-light); padding-bottom: 0;">
            <a href="{{ route('stock.in') }}" class="nav-link">
                Stock In
            </a>
            <a href="{{ route('stock.out') }}" class="nav-link active">
                Stock Out
            </a>
            <a href="{{ route('stock.history') }}" class="nav-link">
                History
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('stock.out.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="product_id" class="form-label">Select Product</label>
                        <select name="product_id" id="product_id" required
                            class="form-control @error('product_id') error @enderror">
                            <option value="">Choose a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} ({{ $product->sku }}) - Available: {{ $product->quantity }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="form-label">Quantity to Remove</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="1" required
                            class="form-control @error('quantity') error @enderror">
                        @error('quantity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="3" placeholder="Reason for stock removal, order number, etc."
                            class="form-control">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3" style="justify-content: flex-end; margin-top: 2rem;">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Remove Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection