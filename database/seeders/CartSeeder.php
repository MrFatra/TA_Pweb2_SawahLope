<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = [
            [
                'ticket_id' => 1,
                'menu_id' => 1,
                'quantity' => 2,
            ],
            [
                'ticket_id' => 1,
                'menu_id' => 3, 
                'quantity' => 1,
            ],
            [
                'ticket_id' => 1,
                'menu_id' => 2,
                'quantity' => 1,
            ],
        ];

        foreach ($carts as $cart) {
            Cart::create($cart);
        }
    }
}
