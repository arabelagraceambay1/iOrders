@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Product Catalog</h1>
        <p class="io-page-subtitle">Browse products with filters and add to cart quickly.</p>
    </div>
</div>

<section class="io-card">
    <form method="GET" action="{{ route('catalog.index') }}" class="io-grid" style="grid-template-columns:2fr 1fr 1fr auto;align-items:end;gap:0.7rem;">
        <div>
            <label class="io-label">Search</label>
            <input type="search" name="q" value="{{ request('q') }}" class="io-input" placeholder="Search product name">
        </div>
        <div>
            <label class="io-label">Category</label>
            <select name="category" class="io-select">
                <option>All Categories</option>
                <option>Beverages</option>
                <option>Meals</option>
                <option>Snacks</option>
            </select>
        </div>
        <div>
            <label class="io-label">Sort</label>
            <select name="sort" class="io-select">
                <option>Most Relevant</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
            </select>
        </div>
        <button type="submit" class="io-btn io-btn-soft">Apply</button>
    </form>
</section>

<div class="io-grid io-section-space" style="grid-template-columns:repeat(auto-fit,minmax(230px,1fr));">
    @forelse ($products as $product)
        <article class="io-card">
            <h2 style="font-size:1.06rem;color:#194522;">{{ $product->name }}</h2>
            <p class="io-muted" style="font-size:0.88rem;margin-top:0.4rem;">{{ $product->description }}</p>
            <div class="io-section-space" style="display:flex;justify-content:space-between;align-items:center;">
                <p style="font-weight:700;color:#1b5e20;">Php {{ number_format($product->price, 2) }}</p>
                <span class="io-chip">Stock {{ $product->stock_quantity }}</span>
            </div>

            @auth
                @if (auth()->user()->role === 'customer')
                    <form action="{{ route('cart.store') }}" method="POST" class="io-grid" style="grid-template-columns:92px 1fr;margin-top:0.8rem;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="io-input">
                        <button type="submit" class="io-btn io-btn-primary">Add to Cart</button>
                    </form>
                @endif
            @endauth
        </article>
    @empty
        <p class="io-muted">No active products available.</p>
    @endforelse
</div>
@endsection
