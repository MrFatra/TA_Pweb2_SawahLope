<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    protected $fillable = ['menu_id', 'rating'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
