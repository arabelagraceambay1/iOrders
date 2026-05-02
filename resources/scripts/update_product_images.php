<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

$mapping = [
    'Republic Cement' => 'products/republic-cement.jpg',
    'High Performance Silicon Sealant' => 'products/silicon-sealant.jpg',
    'Bonsy Spray Paint (Black)' => 'products/bonsy-spray-paint-black.jpg',
    'RSB 9mm 1.9 (Green)' => 'products/rsb-9mm-green.jpg',
    'GI Pipe S40 1 - 1/4' => 'products/gi-pipe-s40-1-1-4.png',
    'GI Pipe S40 1 - 1/2' => 'products/gi-pipe-s40-1-1-2.png',
    'Tabular 2x2(Blue) 2.0' => 'products/tabular-2x2-blue.jpg',
    'Tabular 2x3(Blue) 2.0' => 'products/tabular-2x3-blue.jpg',
    'GI Steel Matting 3.5' => 'products/gi-steel-matting-3-5.jpg',
    'GI Steel Matting 4.5' => 'products/gi-steel-matting-4-5.jpg',
    'Flat Bar 3/8x2 - 1/2' => 'products/flat-bar-3-8x2-1-2.jpg',
    'Round Bar 8mm' => 'products/round-bar-8mm.jpg',
    'Tabular 3/4x3/4(Red) 1.5' => 'products/tabular-red-1-5.jpg',
    'GI Pipe S40 3/4' => 'products/gi-pipe-s40-3-4.jpg',
    'Square Bar(Red)' => 'products/square-bar-red.jpg',
    'Channel Bar 2x5x5mm' => 'products/channel-bar-2x5x5mm.jpg',
    'C Purlins 2x3(Green)' => 'products/c-purlins-2x3-green.jpg',
    'Tabular 1x1x1.5(Red)' => 'products/tabular-1x1x1-5-red.jpg',
    'Hardiflex 3.5' => 'products/hardiflex-3-5.jpg',
    'Ball Valve(Greate Volume) 3/4' => 'products/ball-valve-3-4.jpg',
    'Welcoat Flatwall Enamel(Litro) White' => 'products/welcoat-flatwall-white.jpg',
    'Welcoat QDE White(Litro)' => 'products/welcoat-qde-white.jpg',
    'Welcoat QDE Crystal Green(Litro)' => 'products/welcoat-qde-crystal-green.jpg',
    'Boysen Flat Latex White(Gallon)' => 'products/boysen-flat-latex-white.jpg',
    'Rain or Shine 701 E/P(Baguio Green) 16 - LT' => 'products/rain-or-shine-701-16lt.jpg',
    'Rain or Shine 629 E/P Tulips 16 - LT' => 'products/rain-or-shine-629-16lt.jpg',
    'Rain or Shine 701 E/P(Baguio Green) 4 - LT' => 'products/rain-or-shine-701-4lt.jpg',
    'AIMEE Nylon Rope 5mm' => 'products/aimee-nylon-rope-5mm.jpg',
    'AIMEE Nylon Rope 10mm' => 'products/aimee-nylon-rope-10mm.jpg',
    'China Smooth NAil 7/8' => 'products/china-smooth-nail-7-8.jpg',
    'China Smooth NAil 3/4' => 'products/china-smooth-nail-3-4.jpg',
    'Guilder Proxy Primer Gray 4lts' => 'products/guilder-proxy-primer-4l.jpg',
    'Pioneer Elasto Seal Pisil Pack' => 'products/pioneer-elasto-seal-pisil.jpg',
];

echo "Updating product image values...\n";
foreach ($mapping as $name => $path) {
    $product = Product::where('name', $name)->first();
    if (! $product) {
        echo "Missing product: $name\n";
        continue;
    }
    $product->image = $path;
    $product->save();
    echo "Updated: $name -> $path\n";
}

echo "Done.\n";
