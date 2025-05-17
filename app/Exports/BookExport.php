<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F81BD']],
                'alignment' => ['horizontal' => 'center'],
            ],

            'C' => ['font' => ['size' => 14, 'color' => ['rgb' => '333333']]],

            'E' => ['font' => ['size' => 14, 'color' => ['rgb' => '333333']]],

            'A:Z' => [
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name (English)',
            'Name (Arabic)',
            'Description (English)',
            'Description (Arabic)',
            'quantity',
            'rate',
            'publish_year',
            'price',
            'is_available',
            'category_id',
            'publisher_id',
            'author_id',
            'Created At',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::all();
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->getTranslation('name', 'en'),
            $book->getTranslation('name', 'ar'),
            $book->getTranslation('description', 'en'),
            $book->getTranslation('description', 'ar'),
            $book->quantity,
            $book->rate,
            $book->publish_year,
            $book->price,
            $book->is_available == null ?? 0,
            $book->category_id,
            $book->publisher_id,
            $book->author_id,
            $book->created_at,
        ];
    }
}
