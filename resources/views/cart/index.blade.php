@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Shopping Cart</h1>
        <p class="io-page-subtitle">Review selected items before checkout.</p>
    </div>
</div>

<section class="io-card">
    @if ($items === [])
        <p class="io-muted">Your cart is currently empty.</p>
    @else
        <div class="io-list">
            @foreach ($items as $item)
                <article class="io-item-row">
                    <div>
                        <p style="font-weight:600;">{{ $item['product']->name }}</p>
                        <p class="io-muted" style="font-size:0.83rem;">Subtotal: Php {{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                    <div class="io-nav-actions">
                        <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="io-nav-actions">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" max="{{ $item['product']->stock_quantity }}" class="io-input" style="width:84px;">
                            <button type="submit" class="io-btn">Update</button>
                        </form>
                        <form action="{{ route('cart.destroy', $item['product']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="io-btn io-btn-danger">Remove</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="io-section-space" style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:0.7rem;padding-top:0.9rem;border-top:1px solid var(--io-border);">
            <p style="font-size:1.06rem;font-weight:700;color:#1b5e20;">Total: Php {{ number_format($total, 2) }}</p>
            <div class="io-nav-actions">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="io-btn">Clear Cart</button>
                </form>
                <a href="{{ route('orders.create') }}" class="io-btn io-btn-primary">Proceed to Checkout</a>
            </div>
        </div>
    @endif
</section>
@endsection
