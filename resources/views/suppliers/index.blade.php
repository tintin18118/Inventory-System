@extends('layouts.app')

@section('content')
<div class="grid gap-6">
    <div class="flex-between">
        <h2>Suppliers</h2>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Add Supplier
        </a>
    </div>

    <!-- Suppliers Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: var(--text-primary);">{{ $supplier->name }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">{{ Str::limit($supplier->address, 50) }}</div>
                    </td>
                    <td>{{ $supplier->contact_name ?? '-' }}</td>
                    <td>{{ $supplier->phone ?? '-' }}</td>
                    <td>{{ $supplier->email ?? '-' }}</td>
                    <td>
                        <span class="badge badge-success">{{ $supplier->products_count }} Products</span>
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 3rem;">
                        <div style="color: var(--text-muted);">
                            <svg style="width: 64px; height: 64px; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p>No suppliers found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($suppliers->hasPages())
    <div class="pagination">
        @if ($suppliers->onFirstPage())
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Previous</span>
        @else
            <a href="{{ $suppliers->previousPageUrl() }}" class="pagination-item">Previous</a>
        @endif

        @foreach ($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
            @if ($page == $suppliers->currentPage())
                <span class="pagination-item active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
            @endif
        @endforeach


        @if ($suppliers->hasMorePages())
            <a href="{{ $suppliers->nextPageUrl() }}" class="pagination-item">Next</a>
        @else
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Next</span>
        @endif
    </div>
    @endif
</div>
@endsection
