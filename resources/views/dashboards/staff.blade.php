@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Staff Dashboard</h1>
        <p class="io-page-subtitle">Daily order and reservation monitoring.</p>
    </div>
</div>

<div class="io-kpis">
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Today's Orders</p>
        <p class="io-kpi-value">{{ $todayOrders }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Processing</p>
        <p class="io-kpi-value">{{ $processingOrders }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Ready for Pickup</p>
        <p class="io-kpi-value">{{ $readyOrders }}</p>
    </article>
    <article class="io-card io-card-tight">
        <p class="io-muted" style="font-size:0.82rem;">Pending Reservations</p>
        <p class="io-kpi-value">{{ $pendingReservations }}</p>
    </article>
</div>

<div class="io-nav-actions io-section-space">
    <a href="{{ route('orders.index') }}" class="io-btn io-btn-primary">Manage Orders</a>
    <a href="{{ route('reservations.index') }}" class="io-btn io-btn-soft">Manage Reservations</a>
</div>
@endsection
