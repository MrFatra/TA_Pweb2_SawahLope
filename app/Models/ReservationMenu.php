<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationMenu extends Model
{
    protected $table = 'reservation_menu';

    protected $fillable = [
        'reservation_id',
        'menu_id',
        'quantity',
        'subtotal'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
