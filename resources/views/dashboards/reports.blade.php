@extends('layouts.app')

@section('content')
<div class="io-sidebar-layout">
    <aside class="io-sidebar">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('orders.index') }}">Order Management</a>
        <a href="{{ route('reservations.index') }}">Reservations</a>
        <a href="{{ route('catalog.index') }}">Inventory</a>
        <a href="{{ route('admin.reports') }}" class="active">Reports</a>
    </aside>

    <div>
        <div class="io-page-head">
            <div>
                <h1 class="io-page-title">Reports</h1>
                <p class="io-page-subtitle">Order analytics and export tools</p>
            </div>
            <a href="{{ route('admin.reports.download') }}" class="io-btn io-btn-primary">Download PDF</a>
        </div>

        <div class="io-kpis">
            <article class="io-card io-card-tight">
                <p class="io-muted" style="font-size:0.82rem;">Total Sales</p>
                <p class="io-kpi-value">Php {{ number_format($totalSales, 2) }}</p>
            </article>
            <article class="io-card io-card-tight">
                <p class="io-muted" style="font-size:0.82rem;">Completed Orders</p>
                <p class="io-kpi-value">{{ $completedCount }}</p>
            </article>
            <article class="io-card io-card-tight">
                <p class="io-muted" style="font-size:0.82rem;">Total Reservations</p>
                <p class="io-kpi-value">{{ $reservationCount }}</p>
            </article>
        </div>

        <section class="io-card io-section-space">
            <h2 style="font-size:1.08rem;color:#1b5e20;">Latest Orders</h2>
            <div class="io-table-wrap" style="margin-top:0.7rem;">
                <table class="io-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user?->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="io-badge io-badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>Php {{ number_format($order->total, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="io-muted">No report rows available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
