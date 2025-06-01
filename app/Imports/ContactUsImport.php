<?php

namespace App\Imports;

use App\Models\ContactUs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactUsImport implements ToModel, WithHeadingRow
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
        return ContactUs::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'message' => $row['message'],
        ]);
    }
}
