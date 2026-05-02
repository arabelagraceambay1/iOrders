@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Customer Dashboard</h1>
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
        <span class="io-chip">PHIL OIL</span>
        <span class="io-chip">STEEL PORT</span>
        <span class="io-chip">NICKEL AUTO SUPPLY</span>
        <span class="io-chip">NORENELLS</span>
        <span class="io-chip">ONE MAN</span>
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

<section class="io-card io-section-space">
    <div class="io-page-head" style="margin-bottom:0.6rem;">
        <h2 style="font-size:1.08rem;color:#1b5e20;">Available Products</h2>
        <a href="{{ route('catalog.index') }}" class="io-link">View all</a>
    </div>
    <div class="io-grid" style="grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:1rem;">
        @forelse ($products as $product)
            @php
                $productImage = null;
                $productImage = $product->image_url;
            @endphp
            <article class="io-card io-product-card io-product-card-action" style="padding:1rem;" data-name="{{ $product->name }}" data-description="{{ $product->description }}" data-price="₱{{ number_format($product->price, 2) }}" data-stock="{{ $product->stock_quantity }}" data-image="{{ $productImage }}">
                @if($productImage)
                    <img src="{{ $productImage }}" alt="{{ $product->name }}" style="width:100%;height:120px;object-fit:cover;border-radius:0.5rem;margin-bottom:0.5rem;">
                @endif
                <h3 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem;">{{ $product->name }}</h3>
                <p class="io-muted" style="font-size:0.9rem;margin-bottom:0.5rem;">{{ $product->description }}</p>
                <p style="font-weight:600;color:#1b5e20;">₱{{ number_format($product->price, 2) }}</p>
                <p class="io-muted" style="font-size:0.8rem;">Stock: {{ $product->stock_quantity }}</p>
                @if($product->stock_quantity > 0)
                    <form action="{{ route('cart.store') }}" method="POST" style="margin-top:0.5rem;" class="product-card-action-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="io-input" style="width:80px;display:inline-block;margin-right:0.5rem;">
                        <button type="submit" class="io-btn io-btn-primary">Add to Cart</button>
                    </form>
                @else
                    <p class="io-muted" style="font-size:0.8rem;margin-top:0.5rem;">Out of Stock</p>
                @endif
            </article>
        @empty
            <p class="io-muted">No products available.</p>
        @endforelse
    </div>
</section>

<div class="product-detail-overlay" id="productDetailOverlay" role="dialog" aria-modal="true">
    <div class="product-detail-panel" id="productDetailPanel">
        <button type="button" class="product-detail-close" id="productDetailClose" aria-label="Close">×</button>
        <img src="" alt="Product image" id="productDetailImage" style="display:none;">
        <div class="io-details-row" style="margin-bottom:1rem;">
            <div>
                <h2 id="productDetailName">Product Name</h2>
                <p class="io-muted" id="productDetailDescription">Product description goes here.</p>
            </div>
            <span style="font-weight:600;color:#405920;">Stock: <strong id="productDetailStock">0</strong></span>
        </div>
        <p style="font-weight:700;color:#3f5f33;" id="productDetailPrice">₱0.00</p>
        <button type="button" class="io-btn io-btn-primary" id="productDetailCloseButton">Close</button>
    </div>
</div>
@endsection
