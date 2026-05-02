<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@iorder.test'],
            [
                'name' => 'iOrder Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
        );

        User::query()->where('role', 'staff')->delete();

        User::query()->updateOrCreate(
            ['email' => 'customer@iorder.test'],
            [
                'name' => 'iOrder Customer',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
        );

        $products = [
    [
        'name' => 'Republic Cement',
        'description' => 'High-quality construction cement.',
        'price' => 208,
        'stock_quantity' => 80,
        'is_active' => true,
    ],
    [
        'name' => 'High Performance Silicon Sealant',
        'description' => 'Waterproof sealant for various surfaces.',
        'price' => 122,
        'stock_quantity' => 25,
        'is_active' => true,
    ],
    [
        'name' => 'Bonsy Spray Paint (Black)',
        'description' => 'Quick-drying matte black finish.',
        'price' => 83,
        'stock_quantity' => 36,
        'image' => 'products/bonsy-spray-paint-black.jpg',
        'is_active' => true,
    ],
    [
        'name' => 'RSB 9mm 1.9 (Green)',
        'description' => '',
        'price' => 72.20,
        'stock_quantity' => 100,
        'is_active' => true,
    ],
    [
        'name' => 'GI Pipe S40 1 - 1/4',
        'description' => '',
        'price' => 865,
        'stock_quantity' => 15,
        'image' => 'products/gi-pipe-s40-1-1-4.png',
        'is_active' => true,
    ],
    [
        'name' => 'GI Pipe S40 1 - 1/2',
        'description' => '',
        'price' => 1001,
        'stock_quantity' => 10,
        'image' => 'products\gi-pipe-s40-1-1-2.png',
        'is_active' => true,
    ],
    [
        'name' => 'Tabular 2x2(Blue) 2.0',
        'description' => '',
        'price' => 500,
        'stock_quantity' => 10,
        'is_active' => true,
    ],
    [
        'name' => 'Tabular 2x3(Blue) 2.0',
        'description' => '',
        'price' => 650,
        'stock_quantity' => 10,
        'is_active' => true,
    ],
    [
        'name' => 'GI Steel Matting 3.5',
        'description' => '',
        'price' => 250,
        'stock_quantity' => 10,
        'is_active' => true,
    ],
    [
        'name' => 'GI Steel Matting 4.5',
        'description' => '',
        'price' => 500,
        'stock_quantity' => 15,
        'is_active' => true,
    ],
    [
        'name' => 'Flat Bar 3/8x2 - 1/2',
        'description' => '',
        'price' => 700,
        'stock_quantity' => 10,
        'is_active' => true,
    ],
    [
        'name' => 'Round Bar 8mm',
        'description' => '',
        'price' => 83,
        'stock_quantity' => 50,
        'is_active' => true,
    ],
    [
        'name' => 'Tabular 3/4x3/4(Red) 1.5',
        'description' => '',
        'price' => 150,
        'stock_quantity' => 20,
        'is_active' => true,
    ],
    [
        'name' => 'GI Pipe S40 3/4',
        'description' => '',
        'price' => 402,
        'stock_quantity' => 20,
        'is_active' => true,
    ],
    [
        'name' => 'Square Bar(Red)',
        'description' => '',
        'price' => 210,
        'stock_quantity' => 20,
        'is_active' => true,
    ],
    [
        'name' => 'Channel Bar 2x5x5mm',
        'description' => '',
        'price' => 2350,
        'stock_quantity' => 18,
        'image' => 'products/channel-bar-2x5x5mm.jpg',
        'is_active' => true,
    ],
    [
        'name' => 'C Purlins 2x3(Green)',
        'description' => '',
        'price' => 260,
        'stock_quantity' => 40,
        'is_active' => true,
   ], 
    [
        'name' => 'Tabular 1x1x1.5(Red)',
        'description' => '',
        'price' => 185,
        'stock_quantity' => 14,
        'is_active' => true,
    ],
    [
        'name' => 'Hardiflex 3.5',
        'description' => '',
        'price' => 305,
        'stock_quantity' => 30,
        'is_active' => true,
    ],
    [
        'name' => 'Ball Valve(Greate Volume) 3/4',
        'description' => '',
        'price' => 500,
        'stock_quantity' => 10,
        'image' => 'products/ball-valve-3-4.jpg',
        'is_active' => true,
    ],
    [
        'name' => 'Welcoat Flatwall Enamel(Litro) White',
        'description' => '',
        'price' => 175,
        'stock_quantity' => 24,
        'is_active' => true,
    ],
    [
        'name' => 'Welcoat QDE White(Litro)',
        'description' => '',
        'price' => 187,
        'stock_quantity' => 24,
        'is_active' => true,
    ],
    [
        'name' => 'Welcoat QDE Crystal Green(Litro)',
        'description' => '',
        'price' => 500,
        'stock_quantity' => 10,
        'is_active' => true,
    ],
    [
        'name' => 'Boysen Flat Latex White(Gallon)',
        'description' => '',
        'price' => 614.25,
        'stock_quantity' => 12,
        'image' => 'products/boysen-flat-latex-white.jpg',
        'is_active' => true,
    ],
    [
        'name' => 'Rain or Shine 701 E/P(Baguio Green) 16 - LT',
        'description' => '',
        'price' => 2573,
        'stock_quantity' => 5,
        'is_active' => true,
    ],
    [
        'name' => 'Rain or Shine 629 E/P Tulips 16 - LT',
        'description' => '',
        'price' => 2573,
        'stock_quantity' => 5,
        'is_active' => true,
    ],
    [
        'name' => 'Rain or Shine 701 E/P(Baguio Green) 4 - LT',
        'description' => '',
        'price' => 646,
        'stock_quantity' => 16,
        'is_active' => true,
    ],
    [
        'name' => 'AIMEE Nylon Rope 5mm',
        'image' => 'products/aimee-nylon-rope-5mm.jpg',
        'description' => '',
        'price' => 461,
        'stock_quantity' => 6,
        'is_active' => true,
    ],
    [
        'name' => 'AIMEE Nylon Rope 10mm',
        'description' => '',
        'price' => 1669,
        'stock_quantity' => 6,
        'is_active' => true,
    ],
    [
        'name' => 'China Smooth NAil 7/8',
        'description' => '',
        'price' => 83,
        'stock_quantity' => 12,
        'is_active' => true,
    ],
    [
        'name' => 'China Smooth NAil 3/4',
        'description' => '',
        'price' => 88,
        'stock_quantity' => 12,
        'is_active' => true,
    ],
    [
        'name' => 'Guilder Proxy Primer Gray 4lts',
        'description' => '',
        'price' => 789,
        'stock_quantity' => 12,
        'is_active' => true,
    ],
    [
        'name' => 'Pioneer Elasto Seal Pisil Pack',
        'description' => '',
        'price' => 140,
        'stock_quantity' => 30,
        'is_active' => true,
    ],
];
        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
