@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Product</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="form-control @error('name') error @enderror">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                        class="form-control @error('sku') error @enderror">
                    @error('sku')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" required
                            class="form-control @error('price') error @enderror">
                        @error('price')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" required
                            class="form-control @error('supplier_id') error @enderror">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="quantity" class="form-label">Initial Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" required
                            class="form-control @error('quantity') error @enderror">
                        @error('quantity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="minimum_stock" class="form-label">Minimum Stock</label>
                        <input type="number" name="minimum_stock" id="minimum_stock" value="{{ old('minimum_stock', 10) }}" required
                            class="form-control @error('minimum_stock') error @enderror">
                        @error('minimum_stock')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3" style="justify-content: flex-end; margin-top: 2rem;">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection