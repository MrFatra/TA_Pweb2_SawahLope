<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'full_name',
        'phone_number',
        'email',
        'seat_number',
        'reservation_date',
        'guest_count',
        'total_price',
        'status'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function reservationMenus()
    {
        return $this->HasMany(ReservationMenu::class, 'reservation_id', 'id');
    }
}
