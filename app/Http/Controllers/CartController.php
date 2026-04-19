<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session('cart', []);
        $productIds = array_keys($cart);

        $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $products->get((int) $productId);

            if (! $product) {
                continue;
            }

            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return view('cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (! $product->is_active) {
            return back()->with('error', 'This product is not available.');
        }

        $cart = session('cart', []);
        $currentQuantity = $cart[$product->id] ?? 0;
        $nextQuantity = $currentQuantity + $validated['quantity'];

        if ($nextQuantity > $product->stock_quantity) {
            return back()->with('error', 'Not enough stock for this product.');
        }

        $cart[$product->id] = $nextQuantity;
        session(['cart' => $cart]);

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $cart = session('cart', []);

        if ($validated['quantity'] === 0) {
            unset($cart[$product->id]);
        } else {
            if ($validated['quantity'] > $product->stock_quantity) {
                return back()->with('error', 'Not enough stock for this product.');
            }

            $cart[$product->id] = $validated['quantity'];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return back()->with('success', 'Cart cleared.');
    }
}
