@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Order Status Tracking</h1>
        <p class="io-page-subtitle">Monitor your order lifecycle in real time.</p>
    </div>
</div>

<section class="io-card">
    <form method="GET" action="{{ route('orders.index') }}" class="io-grid" style="grid-template-columns:1fr auto;align-items:end;gap:0.7rem;">
        <div>
            <label class="io-label">Filter by status</label>
            <select name="status" class="io-select">
                <option>All Statuses</option>
                <option>Pending</option>
                <option>Processing</option>
                <option>Ready</option>
                <option>Completed</option>
            </select>
        </div>
        <button type="submit" class="io-btn">Apply Filter</button>
    </form>
</section>

<div class="io-list io-section-space">
    @forelse ($orders as $order)
        <article class="io-item-row" style="padding:0.9rem;">
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:0.62rem;">
                <div>
                    <p style="font-weight:700;">Order #{{ $order->id }}</p>
                    <p class="io-muted" style="font-size:0.84rem;">Total: Php {{ number_format($order->total, 2) }}</p>
                    @if (auth()->user()->role !== 'customer')
                        <p class="io-muted" style="font-size:0.84rem;">Customer: {{ $order->user->name }}</p>
                    @endif
                </div>
                <span class="io-badge io-badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
            </div>
            <a href="{{ route('orders.show', $order) }}" class="io-btn io-btn-primary">View Details</a>
        </article>
    @empty
        <p class="io-muted">No orders yet.</p>
    @endforelse
</div>
@endsection
