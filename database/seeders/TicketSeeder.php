<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = \App\Models\User::where('id', 1)->first()->id;
        $usernameSlug = \Illuminate\Support\Str::slug('Budi Santoso');
        $randomString = strtoupper(\Illuminate\Support\Str::random(6));
        $ticketCode = "SAWAHLOPE-{$id}-{$usernameSlug}-{$randomString}";

        \App\Models\Ticket::create([
            'full_name' => 'Budi Santoso',
            'phone_number' => '081234567890',
            'email' => 'budi@example.com',
            'ticket_code' => $ticketCode,
            'visit_date' => now()->addDays(2),
            'guest_count' => 2,
            'total_price' => 20000,
            'status' => 'confirmed'
        ]);
    }
}
