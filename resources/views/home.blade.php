@extends('layouts.app')

@section('content')
<div class="io-card" style="padding:1.4rem;">
    <div class="io-page-head" style="margin-bottom:0.7rem;">
        <div>
            <h1 class="io-page-title">iOrder</h1>
        </div>
        <div class="io-nav-actions">
            <a href="{{ route('catalog.index') }}" class="io-btn io-btn-primary">Browse Catalog</a>
            @guest
                <a href="{{ route('login') }}" class="io-btn">Login</a>
                <a href="{{ route('register') }}" class="io-btn io-btn-soft">Register</a>
            @endguest
        </div>
    </div>
</div>

<div class="io-grid io-section-space" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr));">
    <article class="io-card io-card-tight">
        <h3 style="font-size:1rem;color:#1b5e20;">Ordering</h3>
        <p class="io-muted" style="font-size:0.9rem;margin-top:0.35rem;">Search products, add items to cart, and submit pickup orders online.</p>
    </article>
    <article class="io-card io-card-tight">
        <h3 style="font-size:1rem;color:#1b5e20;">Reservations</h3>
        <p class="io-muted" style="font-size:0.9rem;margin-top:0.35rem;">Book reservations with schedule selection and track status updates.</p>
    </article>
    <article class="io-card io-card-tight">
        <h3 style="font-size:1rem;color:#1b5e20;">Operations</h3>
        <p class="io-muted" style="font-size:0.9rem;margin-top:0.35rem;">Admin users can monitor orders, reservations, and reporting data.</p>
    </article>
</div>
@endsection
