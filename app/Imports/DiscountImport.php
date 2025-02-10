<?php

namespace App\Imports;

use DateTime;
use App\Models\Discount;
use Ramsey\Uuid\Type\Integer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DiscountImport implements ToModel, WithHeadingRow
{
    // public function headingRow(): int
    // {
    //     return 0;
    // }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Discount::updateOrCreate(['code' => $row['code']], [
            'code' => $row['code'],
            'quantity' =>  $row['quantity'],
            'precentage' =>  $row['precentage'],
            'expiry_date' => $row['expiry_date'],
        ]);
    }
}
