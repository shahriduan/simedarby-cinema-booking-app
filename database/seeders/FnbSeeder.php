<?php

namespace Database\Seeders;

use App\Models\Fnb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FnbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fnbs = [
            // --- COMBO CATEGORY ---
            [
                'category'    => 'Combo',
                'name'        => 'Tasty Combo',
                'description' => '2 Shawarma, Pack of fries & Pepsi',
                'unit_price'  => 28.00,
            ],
            [
                'category'    => 'Combo',
                'name'        => 'Fresh XL Combo',
                'description' => 'Double large popcorn and 4 pepsi',
                'unit_price'  => 42.00,
            ],
            [
                'category'    => 'Combo',
                'name'        => 'Yummy combo',
                'description' => '2 hotdogs, 2 Lays chips & 4 pepsi',
                'unit_price'  => 45.00,
            ],
            [
                'category'    => 'Combo',
                'name'        => 'Fresh Combo',
                'description' => 'Large popcorn & candy with pepsi',
                'unit_price'  => 22.00,
            ],
            [
                'category'    => 'Combo',
                'name'        => 'Special Combo',
                'description' => 'Chicken Shawarma & Pack of fries',
                'unit_price'  => 20.50,
            ],
            [
                'category'    => 'Combo',
                'name'        => 'Delight Combo',
                'description' => 'Double pack medium popcorn',
                'unit_price'  => 19.00,
            ],

            // --- FOOD/SNACKS CATEGORY ---
            [
                'category'    => 'Food/Snacks',
                'name'        => 'Signature Caramel Popcorn (Large)',
                'description' => 'Classic theater sweet caramel popcorn',
                'unit_price'  => 16.50,
            ],
            [
                'category'    => 'Food/Snacks',
                'name'        => 'Hotdog (Beef/Chicken)',
                'description' => 'Grilled sausage in a warm bun with mustard & ketchup',
                'unit_price'  => 11.00,
            ],

            // --- BEVERAGES CATEGORY ---
            [
                'category'    => 'Beverages',
                'name'        => 'Pepsi (Large)',
                'description' => 'Chilled refreshing Pepsi cola (Large cup)',
                'unit_price'  => 8.50,
            ],
            [
                'category'    => 'Beverages',
                'name'        => 'Mineral Water',
                'description' => '600ml bottled clean drinking water',
                'unit_price'  => 5.00,
            ],
        ];

        foreach ($fnbs as $fnb) {
            Fnb::create($fnb);
        }
    }
}
