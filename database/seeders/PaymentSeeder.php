<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Payment::create([
            'full_name' => 'Budi Santoso',
            'phone_number' => '081234567890',
            'email' => 'budi@example.com',
            'payable_id' => 1,
            'payable_type' => \App\Models\Ticket::class,
            'amount' => 100000,
            'status' => 'paid',
            'payment_method' => 'qris',
            'transaction_id' => 'TX123456789'
        ]);
    }
}
