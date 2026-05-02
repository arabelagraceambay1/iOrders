<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

$names = [
    'AIMEE Nylon Rope 10mm',
    'Ball Valve(Greate Volume) 3/4',
    'GI Pipe S40 1 - 1/4',
    'Republic Cement',
    'Round Bar 8mm',
];

foreach (Product::whereIn('name', $names)->get() as $p) {
    echo $p->name . ' => [' . $p->image . '] => [' . $p->image_url . ']' . PHP_EOL;
}
