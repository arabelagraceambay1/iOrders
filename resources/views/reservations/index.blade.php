@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Reservations</h1>
        <p class="io-page-subtitle">Track booking schedules and updates.</p>
    </div>
    @if (auth()->user()->role === 'customer')
        <a href="{{ route('reservations.create') }}" class="io-btn io-btn-primary">New Reservation</a>
    @endif
</div>

<div class="io-list">
    @forelse ($reservations as $reservation)
        <article class="io-item-row" style="padding:0.9rem;">
            <div style="font-size:0.9rem;">
                <p><strong>Date:</strong> {{ $reservation->reserved_for->format('M d, Y h:i A') }}</p>
                <p><strong>Party Size:</strong> {{ $reservation->party_size }}</p>
                <div style="margin-top:0.3rem;">
                    <span class="io-badge io-badge-{{ strtolower($reservation->status) }}">{{ ucfirst($reservation->status) }}</span>
                </div>
                @if (auth()->user()->role !== 'customer')
                    <p class="io-muted" style="font-size:0.82rem;margin-top:0.35rem;">Customer: {{ $reservation->user->name }}</p>
                @endif
                @if ($reservation->notes)
                    <p class="io-muted" style="font-size:0.82rem;margin-top:0.2rem;">Notes: {{ $reservation->notes }}</p>
                @endif
            </div>

            @if (auth()->user()->role !== 'customer')
                <form action="{{ route('reservations.status', $reservation) }}" method="POST" class="io-nav-actions">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="io-select" style="min-width:150px;">
                        @foreach (['pending', 'approved', 'rejected', 'completed', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected($reservation->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="io-btn">Update</button>
                </form>
            @endif
        </article>
    @empty
        <p class="io-muted">No reservations available.</p>
    @endforelse
</div>
@endsection
