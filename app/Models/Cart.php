<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'ticket_code',
        'menu_id',
        'quantity',
    ];

    public function ticket()
    {
        return $this->belongsTo(ticket::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
