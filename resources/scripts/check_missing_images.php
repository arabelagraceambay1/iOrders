<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

$countTotal = Product::count();
$countWithImage = Product::whereNotNull('image')->where('image', '!=', '')->count();
$countWithoutImage = $countTotal - $countWithImage;

echo "Total products: $countTotal\n";
echo "Products with image value: $countWithImage\n";
echo "Products missing image value: $countWithoutImage\n\n";

foreach (Product::whereNull('image')->orWhere('image', '')->orderBy('name')->get() as $p) {
    echo "MISSING: {$p->name}\n";
}
