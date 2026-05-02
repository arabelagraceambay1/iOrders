@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Admin Management</h1>
    </div>
    <div class="io-nav-actions">
        <a href="{{ route('products.index') }}" class="io-btn io-btn-primary">Manage Products</a>
    </div>
</div>

<div class="io-kpis">
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Total Products</p>
        <p class="io-kpi-value">{{ $productCount }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Low Stock Items</p>
        <p class="io-kpi-value">{{ $lowStockCount }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Pending Orders</p>
        <p class="io-kpi-value">{{ $pendingOrderCount }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Pending Reservations</p>
        <p class="io-kpi-value">{{ $pendingReservationCount }}</p>
    </article>
</div>

<section class="io-card io-section-space io-section-title-card">
    <h2 class="io-section-title">Orders & Reservations Summary</h2>
    <p class="io-muted">See current pending and completed order and reservation totals.</p>
</section>

<section class="io-card io-section-space">
    <div class="io-grid io-section-space" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
        <article class="io-card io-card-tight" style="background:#eef5ea;">
            <p class="io-muted" style="font-size:0.82rem;">Pending Orders</p>
            <p class="io-kpi-value">{{ $pendingOrderCount }}</p>
        </article>
        <article class="io-card io-card-tight" style="background:#f2f7ed;">
            <p class="io-muted" style="font-size:0.82rem;">Completed Orders</p>
            <p class="io-kpi-value">{{ $completedOrderCount }}</p>
        </article>
        <article class="io-card io-card-tight" style="background:#eef5ea;">
            <p class="io-muted" style="font-size:0.82rem;">Pending Reservations</p>
            <p class="io-kpi-value">{{ $pendingReservationCount }}</p>
        </article>
        <article class="io-card io-card-tight" style="background:#f2f7ed;">
            <p class="io-muted" style="font-size:0.82rem;">Completed Reservations</p>
            <p class="io-kpi-value">{{ $completedReservationCount }}</p>
        </article>
    </div>
</section>
@endsection