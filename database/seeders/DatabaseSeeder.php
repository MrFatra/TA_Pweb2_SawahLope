<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FoodCategorySeeder::class,
            MenuSeeder::class,
            RatingSeeder::class,
            TicketSeeder::class,
            ReservationSeeder::class,
            ReservationMenuSeeder::class,
            PaymentSeeder::class
        ]);
    }
}
