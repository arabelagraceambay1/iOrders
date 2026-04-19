@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Customer Dashboard</h1>
        <p class="io-page-subtitle">Search products, review categories, and track activity.</p>
    </div>
</div>

<section class="io-card">
    <form class="io-grid" style="grid-template-columns:1fr auto;align-items:end;gap:0.7rem;">
        <div>
            <label class="io-label">Search Menu</label>
            <input type="search" class="io-input" placeholder="Search products or categories">
        </div>
        <a href="{{ route('catalog.index') }}" class="io-btn io-btn-primary">Search</a>
    </form>

    <div class="io-section-space" style="display:flex;flex-wrap:wrap;gap:0.5rem;">
        <span class="io-chip">Beverages</span>
        <span class="io-chip">Meals</span>
        <span class="io-chip">Snacks</span>
        <span class="io-chip">Desserts</span>
        <span class="io-chip">Student Favorites</span>
    </div>
</section>

<div class="io-grid io-section-space" style="grid-template-columns:repeat(auto-fit,minmax(290px,1fr));">
    <section class="io-card">
        <div class="io-page-head" style="margin-bottom:0.6rem;">
            <h2 style="font-size:1.08rem;color:#1b5e20;">Recent Orders</h2>
            <a href="{{ route('orders.index') }}" class="io-link">View all</a>
        </div>
        <div class="io-list">
            @forelse ($myOrders as $order)
                <article class="io-item-row">
                    <div>
                        <p style="font-weight:600;">Order #{{ $order->id }}</p>
                        <p class="io-muted" style="font-size:0.84rem;">{{ optional($order->created_at)->format('M d, Y h:i A') }}</p>
                    </div>
                    <span class="io-badge io-badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                </article>
            @empty
                <p class="io-muted">No orders yet.</p>
            @endforelse
        </div>
    </section>

    <section class="io-card">
        <div class="io-page-head" style="margin-bottom:0.6rem;">
            <h2 style="font-size:1.08rem;color:#1b5e20;">Recent Reservations</h2>
            <a href="{{ route('reservations.index') }}" class="io-link">View all</a>
        </div>
        <div class="io-list">
            @forelse ($myReservations as $reservation)
                <article class="io-item-row">
                    <div>
                        <p style="font-weight:600;">{{ $reservation->reserved_for->format('M d, Y') }}</p>
                        <p class="io-muted" style="font-size:0.84rem;">{{ $reservation->reserved_for->format('h:i A') }}</p>
                    </div>
                    <span class="io-badge io-badge-{{ strtolower($reservation->status) }}">{{ ucfirst($reservation->status) }}</span>
                </article>
            @empty
                <p class="io-muted">No reservations yet.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
