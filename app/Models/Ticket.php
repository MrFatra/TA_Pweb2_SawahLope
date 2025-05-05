<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'seat_number',
        'ticket_code',
        'visit_date',
        'guest_count',
        'total_price',
        'status'
    ];

    public static function generateTicketCode($ticket)
    {
        $usernameSlug = \Illuminate\Support\Str::slug($ticket['full_name']);

        $randomString = strtoupper(\Illuminate\Support\Str::random(6));

        return "SAWAHLOPE-{$ticket['id']}-{$usernameSlug}-{$randomString}";
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
