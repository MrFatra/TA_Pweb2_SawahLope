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
        'amount',
        'status',
        'payment_method',
        'transaction_id'
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}
