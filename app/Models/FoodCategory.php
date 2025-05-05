<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'description'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
