@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Reservation Booking</h1>
        <p class="io-page-subtitle">Select your preferred date and time slot.</p>
    </div>
</div>

<section class="io-card" style="max-width:760px;">
    <form action="{{ route('reservations.store') }}" method="POST" class="io-grid">
        @csrf

        <div class="io-grid" style="grid-template-columns:1fr 1fr;gap:0.7rem;">
            <div>
                <label class="io-label">Reservation Date</label>
                <input type="date" id="reserved_date" required class="io-input">
            </div>

            <div>
                <label class="io-label">Reservation Time</label>
                <input type="time" id="reserved_time" required class="io-input">
            </div>
        </div>

        <input type="hidden" id="reserved_for" name="reserved_for">

        <div>
            <label class="io-label">Party Size</label>
            <input type="number" name="party_size" min="1" max="20" required class="io-input">
        </div>

        <div>
            <label class="io-label">Notes</label>
            <textarea name="notes" rows="3" class="io-textarea"></textarea>
        </div>

        <div class="io-nav-actions">
            <button type="submit" class="io-btn io-btn-primary">Submit Reservation</button>
            <a href="{{ route('reservations.index') }}" class="io-btn">Back</a>
        </div>
    </form>

    <script>
        const dateInput = document.getElementById('reserved_date');
        const timeInput = document.getElementById('reserved_time');
        const reservedForInput = document.getElementById('reserved_for');

        function updateReservedFor() {
            if (dateInput.value && timeInput.value) {
                reservedForInput.value = `${dateInput.value} ${timeInput.value}`;
            }
        }

        dateInput.addEventListener('change', updateReservedFor);
        timeInput.addEventListener('change', updateReservedFor);

        document.querySelector('form').addEventListener('submit', updateReservedFor);
    </script>
</section>
@endsection
