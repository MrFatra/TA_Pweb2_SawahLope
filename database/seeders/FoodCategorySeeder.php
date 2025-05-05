<?php

namespace Database\Seeders;

use App\Models\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Makanan Berat', 'Makanan Ringan', 'Minuman', 'Dessert'];
        
        foreach ($categories as $cat) {
            FoodCategory::create([
                'name' => $cat,
                'slug' => \Illuminate\Support\Str::slug($cat),
                'description' => $cat . ' enak dan lezat',
            ]);
        }
    }
}
