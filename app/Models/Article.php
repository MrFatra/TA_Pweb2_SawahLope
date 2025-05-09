<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'category',
        'slug',
        'description',
        'created_by',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
