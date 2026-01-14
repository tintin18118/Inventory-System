@extends('layouts.app')

@section('content')
<div class="grid gap-6">
    <div>
        <h2>Stock History</h2>
        <p class="text-muted">View all stock movements</p>
    </div>

    <div class="flex gap-2" style="border-bottom: 2px solid var(--border-light); padding-bottom: 0;">
        <a href="{{ route('stock.in') }}" class="nav-link">
            Stock In
        </a>
        <a href="{{ route('stock.out') }}" class="nav-link">
            Stock Out
        </a>
        <a href="{{ route('stock.history') }}" class="nav-link active">
            History
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>User</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $history)
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $history->created_at->format('M d, Y') }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">{{ $history->created_at->format('H:i A') }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-primary);">{{ $history->product->name }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted); font-family: monospace;">{{ $history->product->sku }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $history->type == 'in' ? 'badge-success' : 'badge-danger' }}">
                            {{ $history->type == 'in' ? 'Stock In' : 'Stock Out' }}
                        </span>
                    </td>
                    <td style="font-weight: 700; font-size: 1.125rem; "{{ $history->type == 'in' ? 'color: var(--success);' : 'color: var(--danger);' }}">
                        {{ $history->type == 'in' ? '+' : '-' }}{{ $history->quantity }}
                    </td>
                    <td>{{ $history->user->name ?? 'System' }}</td>
                    <td>{{ $history->notes ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 3rem;">
                        <div style="color: var(--text-muted);">
                            <svg style="width: 64px; height: 64px; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p>No stock movements recorded</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($histories->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($histories->onFirstPage())
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Previous</span>
        @else
            <a href="{{ $histories->previousPageUrl() }}" class="pagination-item">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($histories->getUrlRange(1, $histories->lastPage()) as $page => $url)
            @if ($page == $histories->currentPage())
                <span class="pagination-item active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($histories->hasMorePages())
            <a href="{{ $histories->nextPageUrl() }}" class="pagination-item">Next</a>
        @else
            <span class="pagination-item" style="opacity: 0.5; cursor: not-allowed;">Next</span>
        @endif
    </div>
    @endif
</div>
@endsection