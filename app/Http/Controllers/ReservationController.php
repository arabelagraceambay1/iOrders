<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(): View
    {
        $query = Reservation::query()->with('user')->latest();

        if (auth()->user()->role === 'customer') {
            $query->where('user_id', auth()->id());
        }

        return view('reservations.index', [
            'reservations' => $query->get(),
        ]);
    }

    public function create(): View
    {
        return view('reservations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reserved_for' => ['required', 'date', 'after:now'],
            'party_size' => ['required', 'integer', 'min:1', 'max:20'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'reserved_for' => $validated['reserved_for'],
            'party_size' => $validated['party_size'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation submitted.');
    }

    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,completed,cancelled'],
        ]);

        $reservation->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Reservation status updated.');
    }
}
