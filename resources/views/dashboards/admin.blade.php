@extends('layouts.app')

@section('content')
<div class="io-sidebar-layout">
    <aside class="io-sidebar">
        <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('orders.index') }}">Order Management</a>
        <a href="{{ route('reservations.index') }}">Reservations</a>
        <a href="{{ route('catalog.index') }}">Inventory</a>
        <a href="{{ route('admin.reports') }}">Reports</a>
    </aside>

    <div>
        <div class="io-page-head">
            <div>
                <h1 class="io-page-title">Admin Dashboard</h1>
                <p class="io-page-subtitle">Operations overview and quick actions</p>
            </div>
            <a href="{{ route('admin.reports') }}" class="io-btn io-btn-primary">Open Reports</a>
        </div>

        <div class="io-kpis">
            <article class="io-card io-card-tight">
                <p class="io-muted" style="font-size:0.82rem;">Products</p>
                <p class="io-kpi-value">{{ $productCount }}</p>
            </article>
            <article class="io-card io-card-tight">
                <p class="io-muted" style="font-size:0.82rem;">Low Stock</p>
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

        <section class="io-card io-section-space">
            <h2 style="font-size:1.08rem;color:#1b5e20;">Quick Actions</h2>
            <p class="io-muted" style="margin-top:0.25rem;font-size:0.9rem;">Use these shortcuts to manage daily workflows.</p>
            <div class="io-nav-actions" style="margin-top:0.8rem;">
                <a href="{{ route('orders.index') }}" class="io-btn io-btn-primary">Review Orders</a>
                <a href="{{ route('reservations.index') }}" class="io-btn io-btn-soft">Review Reservations</a>
                <a href="{{ route('catalog.index') }}" class="io-btn">View Inventory</a>
            </div>
        </section>
    </div>
</div>
@endsection
