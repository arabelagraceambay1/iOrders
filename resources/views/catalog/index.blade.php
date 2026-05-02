@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Product Catalog</h1>
    </div>
</div>

<section class="io-card">
    <form class="io-grid" style="grid-template-columns:1fr auto auto;align-items:end;gap:0.7rem;">
        <div>
            <label class="io-label">Search Products</label>
            <input type="search" name="q" value="{{ request('q') }}" class="io-input" placeholder="Search by name">
            <input type="hidden" name="category" value="{{ request('category') }}">
        </div>
        <div>
            <label class="io-label">Sort By</label>
            <select name="sort" class="io-input">
                <option value="">Name (A-Z)</option>
                <option value="Price: Low to High" {{ request('sort') === 'Price: Low to High' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="Price: High to Low" {{ request('sort') === 'Price: High to Low' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>
        <button type="submit" class="io-btn io-btn-primary">Search</button>
    </form>

    <div class="io-section-space" style="display:flex;flex-wrap:wrap;gap:0.5rem;">
        @foreach(['PHIL OIL', 'STEEL PORT', 'NICKEL AUTO SUPPLY', 'NORENELLS', 'ONE MAN'] as $chip)
            <a href="{{ request()->fullUrlWithQuery(['category' => $chip, 'q' => request('q'), 'sort' => request('sort')]) }}" class="io-chip {{ request('category') === $chip ? 'active' : '' }}">{{ $chip }}</a>
        @endforeach
        <a href="{{ request()->fullUrlWithoutQuery('category') }}" class="io-chip {{ request()->filled('category') ? '' : 'active' }}">All</a>
    </div>
</section>

<section class="io-card io-section-space">
    <div class="io-page-head" style="margin-bottom:0.6rem;">
        <h2 style="font-size:1.08rem;color:#1b5e20;">Available Products</h2>
    </div>
    <div class="io-grid" style="grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;">
        @forelse ($products as $product)
            @php
                $productImage = $product->image_url;
            @endphp
            <article class="io-card" style="padding:1rem;">
                @if($productImage)
                    <img src="{{ $productImage }}" alt="{{ $product->name }}" style="width:100%;height:150px;object-fit:cover;border-radius:0.5rem;margin-bottom:0.5rem;">
                @endif
                <h3 style="font-size:1rem;font-weight:600;margin-bottom:0.5rem;">{{ $product->name }}</h3>
                <p class="io-muted" style="font-size:0.9rem;margin-bottom:0.5rem;">{{ $product->description }}</p>
                <p style="font-weight:600;color:#1b5e20;">₱{{ number_format($product->price, 2) }}</p>
                <p class="io-muted" style="font-size:0.8rem;">Stock: {{ $product->stock_quantity }}</p>
                @auth
                    @if(auth()->user()->role === 'customer')
                        @if($product->stock_quantity > 0)
                            <form action="{{ route('cart.store') }}" method="POST" style="margin-top:0.5rem;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="io-input" style="width:80px;display:inline-block;margin-right:0.5rem;">
                                <button type="submit" class="io-btn io-btn-primary">Add to Cart</button>
                            </form>
                        @else
                            <p class="io-muted" style="font-size:0.8rem;margin-top:0.5rem;">Out of Stock</p>
                        @endif
                    @endif
                @endauth
            </article>
        @empty
            <p class="io-muted">No products available.</p>
        @endforelse
    </div>
</section>
@endsection
