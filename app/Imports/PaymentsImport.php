<?php

namespace App\Imports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\ToModel;

class PaymentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Payment([
            'order_id' => $row['order_id'],
            'full_name' => $row['full_name'],
            'payable_type' => $row['payable_type'],
            'payable_id' => $row['payable_id'],
            'gross_amount' => $row['gross_amount'],
            'payment_method' => $row['payment_method'],
            'status' => $row['status'],
        ]);
    }
}
