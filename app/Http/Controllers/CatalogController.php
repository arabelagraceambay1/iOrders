<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()->where('is_active', true);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->string('q')->trim().'%');
        }

        if ($request->input('sort') === 'Price: Low to High') {
            $query->orderBy('price');
        } elseif ($request->input('sort') === 'Price: High to Low') {
            $query->orderByDesc('price');
        } else {
            $query->orderBy('name');
        }

        return view('catalog.index', [
            'products' => $query->get(),
        ]);
    }
}
