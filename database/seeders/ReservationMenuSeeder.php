<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservationMenus = [
            [
                'reservation_id' => 1,
                'menu_id' => 2,
                'quantity' => 1,
                'subtotal' => 5000
            ],
            [
                'reservation_id' => 1,
                'menu_id' => 1,
                'quantity' => 1,
                'subtotal' => 25000
            ]
        ];

        foreach ($reservationMenus as $reservationMenu) {
            \App\Models\ReservationMenu::create($reservationMenu);
        }
    }
}
