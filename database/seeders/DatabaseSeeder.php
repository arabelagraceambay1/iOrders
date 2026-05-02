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

    }
}