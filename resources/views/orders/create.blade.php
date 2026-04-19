@extends('layouts.app')

@section('content')
<h1 class="mb-4 text-2xl font-bold">Confirm Order Request</h1>

<div class="grid gap-4 md:grid-cols-2">
    <section class="rounded-lg bg-white p-4 shadow">
        <h2 class="text-lg font-semibold">Order Items</h2>
        <ul class="mt-3 space-y-2 text-sm">
            @foreach ($items as $item)
                <li class="flex justify-between border-b border-slate-200 pb-2">
                    <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                    <span>Php {{ number_format($item['subtotal'], 2) }}</span>
                </li>
            @endforeach
        </ul>
        <p class="mt-3 text-lg font-semibold">Total: Php {{ number_format($total, 2) }}</p>
    </section>

    <section class="rounded-lg bg-white p-4 shadow">
        <h2 class="text-lg font-semibold">Pickup Details</h2>

        <form action="{{ route('orders.store') }}" method="POST" class="mt-3 space-y-3">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-medium">Pickup Date and Time</label>
                <input type="datetime-local" name="pickup_at" required class="w-full rounded border border-slate-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Payment Reference (Optional)</label>
                <input type="text" name="payment_reference" value="{{ old('payment_reference') }}" class="w-full rounded border border-slate-300 px-3 py-2" placeholder="GCash ref number">
            </div>

            <button type="submit" class="rounded bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-500">Submit Order</button>
        </form>
    </section>
</div>
@endsection
