<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(): RedirectResponse|View
    {
        $cart = session('cart', []);

        if ($cart === []) {
            return redirect()->route('catalog.index')->with('error', 'Your cart is empty.');
        }

        $products = Product::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $products->get((int) $productId);

            if (! $product) {
                continue;
            }

            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $items[] = compact('product', 'quantity', 'subtotal');
        }

        if ($items === []) {
            return redirect()->route('catalog.index')->with('error', 'Your cart has invalid items.');
        }

        return view('orders.create', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pickup_at' => ['required', 'date', 'after:now'],
            'payment_reference' => ['nullable', 'string', 'max:255'],
        ]);

        $cart = session('cart', []);

        if ($cart === []) {
            return redirect()->route('catalog.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($cart, $validated) {
            $products = Product::query()
                ->whereIn('id', array_keys($cart))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $total = 0;
            $rows = [];

            foreach ($cart as $productId => $quantity) {
                $product = $products->get((int) $productId);

                if (! $product || ! $product->is_active) {
                    abort(422, 'One or more products are unavailable.');
                }

                if ($quantity > $product->stock_quantity) {
                    abort(422, 'Not enough stock for '.$product->name.'.');
                }

                $subtotal = $product->price * $quantity;
                $total += $subtotal;

                $rows[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'pickup_at' => $validated['pickup_at'],
                'total' => $total,
                'payment_reference' => $validated['payment_reference'] ?? null,
            ]);

            foreach ($rows as $row) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'quantity' => $row['quantity'],
                    'unit_price' => $row['unit_price'],
                    'subtotal' => $row['subtotal'],
                ]);

                Product::query()->whereKey($row['product_id'])->decrement('stock_quantity', $row['quantity']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order submitted successfully.');
    }

    public function index(): View
    {
        $query = Order::query()->with(['user', 'items.product'])->latest();

        if (auth()->user()->role === 'customer') {
            $query->where('user_id', auth()->id());
        }

        $status = request('status');
        if (is_string($status) && $status !== '' && $status !== 'All Statuses') {
            $query->where('status', strtolower($status));
        }

        return view('orders.index', [
            'orders' => $query->get(),
        ]);
    }

    public function show(Order $order): View
    {
        if (auth()->user()->role === 'customer' && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['user', 'items.product']);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function uploadProof(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_proof' => ['required', 'image', 'max:3072'],
        ]);

        $path = $validated['payment_proof']->store('payment-proofs', 'public');

        $order->update([
            'payment_proof_path' => $path,
        ]);

        return back()->with('success', 'Payment proof uploaded.');
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,processing,ready,rejected,completed'],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Order status updated.');
    }
}
