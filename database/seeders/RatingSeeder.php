<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            [
                'menu_id' => 1,
                'rating' => 5
            ],
            [
                'menu_id' => 2,
                'rating' => 5
            ],
            [
                'menu_id' => 1,
                'rating' => 4
            ],
        ];

        foreach ($ratings as $rating) {
            \App\Models\Rating::create($rating);
        }
    }
}
