@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">New Reservation</h1>
    </div>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('reservations.store') }}" method="POST" class="io-card">
        @csrf
        <div class="io-section-space">
            <label class="io-label">Date & Time</label>
            <input type="datetime-local" name="reserved_for" class="io-input" required>
        </div>

        <div class="io-section-space">
            <label class="io-label">Party Size (Max 20)</label>
            <input type="number" name="party_size" class="io-input" min="1" max="20" value="1" required>
        </div>

        <div class="io-section-space">
            <label class="io-label">Additional Notes</label>
            <textarea name="notes" class="io-input" rows="3" placeholder="Any special requests?"></textarea>
        </div>

        <div style="display: flex; gap: 0.5rem; margin-top: 1.5rem;">
            <button type="submit" class="io-btn io-btn-primary">Submit Reservation</button>
            <a href="{{ route('dashboard') }}" class="io-btn io-btn-soft">Cancel</a>
        </div>
    </form>
</div>
@endsection