<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Reservation::create([
            'ticket_id' => 1,
            'full_name' => 'Budi Santoso',
            'phone_number' => '081234567890',
            'email' => 'budi@example.com',
            'seat_number' => 12,
            'reservation_date' => now()->addDays(2),
            'guest_count' => 2,
            'total_price' => 50000,
            'status' => 'confirmed'
        ]);
    }
}
