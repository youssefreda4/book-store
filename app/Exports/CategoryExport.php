<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromCollection, WithHeadings, WithMapping ,WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F81BD']],
                'alignment' => ['horizontal' => 'center']
            ],

            'C' => ['font' => ['size' => 14, 'color' => ['rgb' => '333333']]],

            'A:Z' => [
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name (English)',
            'Name (Arabic)',
            'Created At',
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->getTranslation('name', 'en'),
            $category->getTranslation('name', 'ar'),
            $category->created_at,
        ];
    }
}
