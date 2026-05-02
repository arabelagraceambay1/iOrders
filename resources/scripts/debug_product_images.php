<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$activeCount = Product::where('is_active', true)->count();
$imageCount = Product::where('is_active', true)->whereNotNull('image')->where('image', '<>', '')->count();
$images = Product::where('is_active', true)->whereNotNull('image')->where('image', '<>', '')->limit(20)->pluck('image')->toArray();
$missing = Product::where('is_active', true)->where(function ($query) {
    $query->whereNull('image')->orWhere('image', '')->orWhere('image', 'LIKE', ' %');
})->count();
$missingProducts = Product::where('is_active', true)->where(function ($query) {
    $query->whereNull('image')->orWhere('image', '')->orWhere('image', 'LIKE', ' %');
})->limit(20)->pluck('name')->toArray();

echo "ACTIVE_COUNT: {$activeCount}\n";
echo "IMAGE_COUNT: {$imageCount}\n";
echo "MISSING_IMAGE_COUNT: {$missing}\n";
echo "SAMPLE_IMAGES:\n";
foreach ($images as $img) {
    echo "- {$img}\n";
}
echo "MISSING_PRODUCT_NAMES:\n";
foreach ($missingProducts as $name) {
    echo "- {$name}\n";
}
