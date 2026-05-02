@extends('layouts.app')

@section('content')
<div class="io-page-head">
    <div>
        <h1 class="io-page-title">Admin Product Management</h1>
    </div>
</div>

<div class="io-nav-actions io-section-space">
    <a href="{{ route('dashboard') }}" class="io-btn">Back to Dashboard</a>
    <a href="#new-product" class="io-btn io-btn-primary">Upload New Product</a>
</div>

<section class="io-card io-section-space io-section-title-card">
    <h2 class="io-section-title">Inventory workspace</h2>
    <p class="io-muted">This admin interface is designed for fast product uploads, immediate restock updates, and streamlined catalog changes.</p>
</section>

<section class="io-card io-section-space" id="new-product">
    <h2 class="io-section-title">Upload New Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="io-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
            <div>
                <label class="io-label">Product Name</label>
                <input type="text" name="name" class="io-input" placeholder="e.g. Premium Cement" required>
            </div>
            <div>
                <label class="io-label">Price (Php)</label>
                <input type="number" step="0.01" name="price" class="io-input" required>
            </div>
            <div>
                <label class="io-label">Initial Stock</label>
                <input type="number" name="stock_quantity" class="io-input" required>
            </div>
            <div>
                <label class="io-label">Category</label>
                <input type="text" name="category" class="io-input" placeholder="e.g. Building Materials">
            </div>
            <div style="grid-column: 1 / -1;">
                <label class="io-label">Product Image</label>
                <input type="file" name="image" class="io-input">
            </div>
            <div style="grid-column: 1 / -1;">
                <label class="io-label">Description</label>
                <textarea name="description" class="io-input" rows="3" placeholder="Enter product details"></textarea>
            </div>
        </div>
        <button type="submit" class="io-btn io-btn-primary" style="margin-top:1rem;">Upload Product</button>
    </form>
</section>

<section class="io-section-space">
    <div class="io-card io-section-title-card">
        <h2 class="io-section-title">Live Inventory Manager</h2>
        <p class="io-muted">Edit product details and restock quantities without leaving this page.</p>
    </div>

    <div class="io-grid io-section-space" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
        @forelse($products as $product)
            <article class="io-card io-product-card">
                <header class="io-product-card-header">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="io-product-image">
                    @else
                        <div class="io-product-image io-product-image-placeholder">No image</div>
                    @endif
                    <div>
                        <p class="io-muted" style="font-size:0.78rem; text-transform: uppercase; letter-spacing:0.08em;">{{ $product->category ?? 'General' }}</p>
                        <h3 style="margin:0.45rem 0;">{{ $product->name }}</h3>
                        <div class="io-product-meta">
                            <span class="io-badge" style="border-color: rgba(91, 107, 81, 0.2); background: rgba(91, 107, 81, 0.1); color: #3c6334;">Stock: {{ $product->stock_quantity }}</span>
                            @if($product->stock_quantity <= 5)
                                <span class="io-badge" style="border-color: rgba(189, 93, 48, 0.2); background: rgba(189, 93, 48, 0.1); color: #924a2e;">Low Stock</span>
                            @endif
                        </div>
                    </div>
                </header>

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="io-grid" style="grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                        <div>
                            <label class="io-label">Name</label>
                            <input type="text" name="name" class="io-input" value="{{ $product->name }}" required>
                        </div>
                        <div>
                            <label class="io-label">Price</label>
                            <input type="number" step="0.01" name="price" class="io-input" value="{{ $product->price }}" required>
                        </div>
                        <div>
                            <label class="io-label">Stock</label>
                            <input type="number" name="stock_quantity" class="io-input" value="{{ $product->stock_quantity }}" required>
                        </div>
                        <div>
                            <label class="io-label">Category</label>
                            <input type="text" name="category" class="io-input" value="{{ $product->category }}">
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <label class="io-label">Change Image</label>
                            <input type="file" name="image" class="io-input">
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <label class="io-label">Description</label>
                            <textarea name="description" class="io-input" rows="2">{{ $product->description }}</textarea>
                        </div>
                    </div>
                    <div class="io-product-actions">
                        <button type="submit" class="io-btn io-btn-primary">Save Changes</button>
                    </div>
                </form>

                <form action="{{ route('products.destroy', $product) }}" method="POST" class="io-product-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="io-btn io-btn-danger">Remove Product</button>
                </form>
            </article>
        @empty
            <div class="io-card">
                <p class="io-muted">No products found yet. Upload your first product to start managing inventory.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
