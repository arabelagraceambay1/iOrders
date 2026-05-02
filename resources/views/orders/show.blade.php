@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Order #{{ $order->id }}</h1>
    </div>
</div>

<div class="io-grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr));">
    <section class="io-card">
        <h2 style="font-size:1.1rem;color:#1b5e20;">Order Details</h2>
        <div class="io-grid" style="margin-top:0.5rem;gap:0.42rem;font-size:0.9rem;">
            <p><strong>Customer:</strong> {{ $order->user->name }}</p>
            <p><strong>Status:</strong> <span class="io-badge io-badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Pickup:</strong> {{ optional($order->pickup_at)->format('M d, Y h:i A') ?? 'Not set' }}</p>
            <p><strong>Payment Ref:</strong> {{ $order->payment_reference ?? 'N/A' }}</p>
            <p><strong>Total:</strong> Php {{ number_format($order->total, 2) }}</p>
        </div>

        <h3 style="margin-top:0.9rem;font-size:1rem;color:#1b5e20;">Items</h3>
        <div class="io-list" style="margin-top:0.45rem;">
            @foreach ($order->items as $item)
                <article class="io-item-row">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                    <strong>Php {{ number_format($item->subtotal, 2) }}</strong>
                </article>
            @endforeach
        </div>
    </section>

    <section class="io-card">
        @if (auth()->user()->role === 'customer')
            <h2 style="font-size:1.1rem;color:#1b5e20;">Upload Payment Proof</h2>

            <form action="{{ route('orders.proof', $order) }}" method="POST" enctype="multipart/form-data" class="io-grid" style="margin-top:0.7rem;">
                @csrf
                <input type="file" name="payment_proof" accept="image/*" required class="io-input">
                <button type="submit" class="io-btn io-btn-primary">Upload Proof</button>
            </form>

            @if ($order->payment_proof_path)
                <div class="io-section-space">
                    <p class="io-muted" style="font-size:0.87rem;">Current uploaded proof</p>
                    <a href="{{ asset('storage/'.$order->payment_proof_path) }}" class="io-link" target="_blank">View image</a>
                </div>
            @endif
        @else
            <h2 style="font-size:1.1rem;color:#1b5e20;">Update Order Status</h2>
            <form action="{{ route('orders.status', $order) }}" method="POST" class="io-grid" style="margin-top:0.7rem;">
                @csrf
                @method('PATCH')
                <select name="status" class="io-select">
                    @foreach (['pending', 'approved', 'processing', 'ready', 'rejected', 'completed'] as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="io-btn io-btn-primary">Update Status</button>
            </form>
        @endif
    </section>
</div>
@endsection
