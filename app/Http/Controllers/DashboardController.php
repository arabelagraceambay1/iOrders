<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboards.admin', [
                'productCount' => Product::count(),
                'lowStockCount' => Product::query()->where('stock_quantity', '<=', 5)->count(),
                'pendingOrderCount' => Order::query()->where('status', 'pending')->count(),
                'pendingReservationCount' => Reservation::query()->where('status', 'pending')->count(),
            ]);
        }

        if ($user->role === 'staff') {
            return view('dashboards.staff', [
                'todayOrders' => Order::query()->whereDate('created_at', now()->toDateString())->count(),
                'processingOrders' => Order::query()->where('status', 'processing')->count(),
                'readyOrders' => Order::query()->where('status', 'ready')->count(),
                'pendingReservations' => Reservation::query()->where('status', 'pending')->count(),
            ]);
        }

        return view('dashboards.customer', [
            'myOrders' => Order::query()->where('user_id', $user->id)->latest()->take(5)->get(),
            'myReservations' => Reservation::query()->where('user_id', $user->id)->latest()->take(5)->get(),
        ]);
    }

    public function reports(): View
    {
        $orders = Order::query()->with('user')->latest()->take(10)->get();

        return view('dashboards.reports', [
            'orders' => $orders,
            'totalSales' => Order::query()->whereIn('status', ['approved', 'processing', 'ready', 'completed'])->sum('total'),
            'reservationCount' => Reservation::count(),
            'completedCount' => Order::query()->where('status', 'completed')->count(),
        ]);
    }

    public function downloadReport(): StreamedResponse
    {
        $fileName = 'iorder-report-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Order ID', 'Customer', 'Status', 'Total', 'Created At']);

            Order::query()
                ->with('user')
                ->latest()
                ->take(200)
                ->get()
                ->each(function (Order $order) use ($handle): void {
                    fputcsv($handle, [
                        $order->id,
                        $order->user?->name ?? 'N/A',
                        $order->status,
                        $order->total,
                        $order->created_at,
                    ]);
                });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
