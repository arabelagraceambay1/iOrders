@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Reservations</h1>
    </div>
    @if(auth()->user()->role === 'customer')
        <a href="{{ route('reservations.create') }}" class="io-btn io-btn-primary">Book New</a>
    @endif
</div>

<div class="io-card">
    <div class="io-table-wrap">
        <table class="io-table">
            <thead>
                <tr>
                    @if(auth()->user()->role !== 'customer') <th>Customer</th> @endif
                    <th>Date & Time</th>
                    <th>Size</th>
                    <th>Status</th>
                    @if(auth()->user()->role !== 'customer') <th>Actions</th> @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $res)
                    <tr>
                        @if(auth()->user()->role !== 'customer') 
                            <td>{{ $res->user->name }}</td> 
                        @endif
                        <td>{{ $res->reserved_for->format('M d, Y h:i A') }}</td>
                        <td>{{ $res->party_size }} pax</td>
                        <td>
                            <span class="io-badge io-badge-{{ strtolower($res->status) }}">
                                {{ ucfirst($res->status) }}
                            </span>
                        </td>
                        @if(auth()->user()->role !== 'customer')
                            <td>
                                <form action="{{ route('reservations.status', $res) }}" method="POST" style="display:inline-flex; gap:4px;">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="io-select" style="padding: 2px 5px; font-size: 0.8rem;">
                                        <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $res->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                        <option value="rejected" {{ $res->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                        <option value="completed" {{ $res->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                    </select>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="5" class="io-muted">No reservations found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection