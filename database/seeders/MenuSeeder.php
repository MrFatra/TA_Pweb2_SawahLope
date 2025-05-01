<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng Spesial',
                'slug' => 'nasi-goreng-spesial',
                'description' => 'Nasi goreng dengan topping lengkap',
                'food_category_id' => 1,
                'image' => 'nasi-goreng.jpg',
                'price' => 25000,
                'is_available' => 'available',
            ],
            [
                'name' => 'Es Teh Manis',
                'slug' => 'es-teh-manis',
                'description' => 'Minuman dingin menyegarkan',
                'food_category_id' => 3,
                'image' => 'es-teh.jpg',
                'price' => 5000,
                'is_available' => 'available',
            ],
            [
                'name' => 'Pudding Coklat',
                'slug' => 'pudding-coklat',
                'description' => 'Pudding coklat yang lembut',
                'food_category_id' => 4,
                'image' => 'pudding-coklat.jpg',
                'price' => 15000,
                'is_available' => 'available',
            ]
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}
