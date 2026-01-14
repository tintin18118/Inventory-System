@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div class="grid gap-6">
        <div>
            <h2>Stock In</h2>
            <p class="text-muted">Add inventory to existing products</p>
        </div>

        <div class="flex gap-2" style="border-bottom: 2px solid var(--border-light); padding-bottom: 0;">
            <a href="{{ route('stock.in') }}" class="nav-link active">
                Stock In
            </a>
            <a href="{{ route('stock.out') }}" class="nav-link">
                Stock Out
            </a>
            <a href="{{ route('stock.history') }}" class="nav-link">
                History
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('stock.in.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="product_id" class="form-label">Select Product</label>
                        <select name="product_id" id="product_id" required
                            class="form-control @error('product_id') error @enderror">
                            <option value="">Choose a product</option>
                            @if(isset($products) && $products->count() > 0)
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} ({{ $product->sku }}) - Current: {{ $product->quantity }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('product_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="form-label">Quantity to Add</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="1" required
                            class="form-control @error('quantity') error @enderror">
                        @error('quantity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="3" placeholder="Reason for stock addition, supplier info, etc."
                            class="form-control">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3" style="justify-content: flex-end; margin-top: 2rem;">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Add Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
