@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Supplier</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Supplier Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="form-control @error('name') error @enderror">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_name" class="form-label">Contact Person</label>
                    <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name') }}"
                        class="form-control @error('contact_name') error @enderror">
                    @error('contact_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="form-control @error('phone') error @enderror">
                        @error('phone')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control @error('email') error @enderror">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="form-control">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3" style="justify-content: flex-end; margin-top: 2rem;">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Create Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
