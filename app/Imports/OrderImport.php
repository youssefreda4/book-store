<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Order::updateOrCreate(
            ['number' => $row['number']],
            [
                'user_id' => $row['user_id'],
                'shipping_area_id' => $row['shipping_area_id'],
                'status' => $row['status'],
                'payment_status' => $row['payment_status'],
                'payment_type' => $row['payment_type'],
                'total' => $row['total'],
                'tax_amount' => $row['tax_amount'],
                'transaction_reference' => $row['transaction_reference'],
                'address' => $row['address'],
                'created_at' => $row['created_at'] ?? now(),
            ]
        );
    }
}
