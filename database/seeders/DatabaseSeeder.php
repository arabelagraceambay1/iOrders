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
                'image' => 'https://www.google.com/imgres?q=bonsy%20spray%20paint%20black&imgurl=https%3A%2F%2Fstatic.wixstatic.com%2Fmedia%2F3c81d2_ecb671368b4c42b8bc858827faf5400d~mv2.png%2Fv1%2Ffill%2Fw_315%2Ch_420%2Cq_75%2Cenc_avif%2Cquality_auto%2F3c81d2_ecb671368b4c42b8bc858827faf5400d~mv2.png&imgrefurl=https%3A%2F%2Fwww.republiccement.com%2Fproducts&docid=owvw8C1XRjI5nM&tbnid=BiLQylA-ipINRM&vet=12ahUKEwjwgMmy1JeUAxXESfUHHRYxEecQnPAOegQIGBAB..i&w=315&h=420&hcb=2&ved=2ahUKEwjwgMmy1JeUAxXESfUHHRYxEecQnPAOegQIGBAB',
                'is_active' => true,
            ],
            [
                'name' => 'RSB 9mm 1.9 (Green)',
                'description' => '',
                'price' => 72.20,
                'stock_quantity' => 100,
                'image' => 'products/rsb-9mm-green.jpg',
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
                'image' => 'products/gi-pipe-s40-1-1-2.png',
                'is_active' => true,
            ],
            [
                'name' => 'Tabular 2x2(Blue) 2.0',
                'description' => '',
                'price' => 500,
                'stock_quantity' => 10,
                'image' => 'products/tabular-2x2-blue.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Tabular 2x3(Blue) 2.0',
                'description' => '',
                'price' => 650,
                'stock_quantity' => 10,
                'image' => 'products/tabular-2x3-blue.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'GI Steel Matting 3.5',
                'description' => '',
                'price' => 250,
                'stock_quantity' => 10,
                'image' => 'products/gi-steel-matting-3-5.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'GI Steel Matting 4.5',
                'description' => '',
                'price' => 500,
                'stock_quantity' => 15,
                'image' => 'products/gi-steel-matting-4-5.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Flat Bar 3/8x2 - 1/2',
                'description' => '',
                'price' => 700,
                'stock_quantity' => 10,
                'image' => 'products/flat-bar-3-8x2-1-2.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Round Bar 8mm',
                'description' => '',
                'price' => 83,
                'stock_quantity' => 50,
                'image' => 'products/round-bar-8mm.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Tabular 3/4x3/4(Red) 1.5',
                'description' => '',
                'price' => 150,
                'stock_quantity' => 20,
                'image' => 'products/tabular-red-1-5.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'GI Pipe S40 3/4',
                'description' => '',
                'price' => 402,
                'stock_quantity' => 20,
                'image' => 'products/gi-pipe-s40-3-4.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Square Bar(Red)',
                'description' => '',
                'price' => 210,
                'stock_quantity' => 20,
                'image' => 'products/square-bar-red.jpg',
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
                'image' => 'products/c-purlins-2x3-green.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Tabular 1x1x1.5(Red)',
                'description' => '',
                'price' => 185,
                'stock_quantity' => 14,
                'image' => 'products/tabular-1x1x1-5-red.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Hardiflex 3.5',
                'description' => '',
                'price' => 305,
                'stock_quantity' => 30,
                'image' => 'products/hardiflex-3-5.jpg',
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
                'image' => 'products/welcoat-flatwall-white.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Welcoat QDE White(Litro)',
                'description' => '',
                'price' => 187,
                'stock_quantity' => 24,
                'image' => 'products/welcoat-qde-white.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Welcoat QDE Crystal Green(Litro)',
                'description' => '',
                'price' => 500,
                'stock_quantity' => 10,
                'image' => 'products/welcoat-qde-crystal-green.jpg',
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
                'image' => 'products/rain-or-shine-701-16lt.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Rain or Shine 629 E/P Tulips 16 - LT',
                'description' => '',
                'price' => 2573,
                'stock_quantity' => 5,
                'image' => 'products/rain-or-shine-629-16lt.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Rain or Shine 701 E/P(Baguio Green) 4 - LT',
                'description' => '',
                'price' => 646,
                'stock_quantity' => 16,
                'image' => 'products/rain-or-shine-701-4lt.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'AIMEE Nylon Rope 5mm',
                'description' => '',
                'price' => 461,
                'stock_quantity' => 6,
                'image' => 'products/aimee-nylon-rope-5mm.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'AIMEE Nylon Rope 10mm',
                'description' => '',
                'price' => 1669,
                'stock_quantity' => 6,
                'image' => 'products/aimee-nylon-rope-10mm.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'China Smooth NAil 7/8',
                'description' => '',
                'price' => 83,
                'stock_quantity' => 12,
                'image' => 'products/china-smooth-nail-7-8.png',
                'is_active' => true,
            ],
            [
                'name' => 'China Smooth NAil 3/4',
                'description' => '',
                'price' => 88,
                'stock_quantity' => 12,
                'image' => 'products/china-smooth-nail-3-4.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Guilder Proxy Primer Gray 4lts',
                'description' => '',
                'price' => 789,
                'stock_quantity' => 12,
                'image' => 'products/guilder-proxy-primer-4l.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Pioneer Elasto Seal Pisil Pack',
                'description' => '',
                'price' => 140,
                'stock_quantity' => 30,
                'image' => 'products/pioneer-elasto-seal-pisil.jpg',
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