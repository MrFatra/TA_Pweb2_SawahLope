<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Payment::select([
            'order_id',
            'full_name',
            'payable_type',
            'payable_id',
            'gross_amount',
            'payment_method',
            'status'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Full Name',
            'Payable Type',
            'Payable ID',
            'Amount',
            'Payment Method',
            'Status',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 40,
            'C' => 20,
            'D' => 20,
            'E' => 40,
            'F' => 20,
            'G' => 20,
        ];
    }
}
