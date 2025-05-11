<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'ticket_id',
        'menu_id',
        'quantity',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
