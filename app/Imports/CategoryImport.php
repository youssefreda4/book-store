<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
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
        return Category::updateOrCreate(['name->en' => $row['name_english']], [
            'name' => [
                'en' => $row['name_english'],
                'ar' => $row['name_arabic'],
            ],
        ]);
    }
}
