<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
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
        return Book::updateOrCreate(['name->en' => $row['name_english']], [
            'name' => [
                'en' => $row['name_english'],
                'ar' => $row['name_arabic'],
            ],
            'description' => [
                'en' => $row['description_english'],
                'ar' => $row['description_arabic'],
            ],
            'quantity' => $row['quantity'],
            'rate' => $row['rate'],
            'publish_year' => $row['publish_year'],
            'price' => $row['price'],
            'is_available' => $row['is_available'] == null ?? 0,
            'category_id' => $row['category_id'],
            'publisher_id' => $row['publisher_id'],
            'author_id' => $row['author_id'],
        ]);
    }
}
