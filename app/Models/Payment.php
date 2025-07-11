<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'payable_id',
        'payable_type',
        'gross_amount',
        'status',
        'payment_method',
        'order_id'
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}
