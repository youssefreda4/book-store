<?php

namespace App\Imports;

use App\Models\FlashSale;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FlashSaleImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return FlashSale::updateOrCreate(['name->en' => $row['name_english']], [
            'name' => [
                'en' => $row['name_english'],
                'ar' => $row['name_arabic'],
            ],
            'description' => [
                'en' => $row['description_english'],
                'ar' => $row['description_arabic'],
            ],
            'is_active' => $row['is_active'],
            'date' => $row['date'],
            'time' => $row['time'],
        ]);
    }
}
