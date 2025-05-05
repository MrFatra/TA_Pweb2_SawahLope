<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'food_category_id',
        'image',
        'price',
        'is_available'
    ];

    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
