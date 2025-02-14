<?php

namespace App\Exports;

use App\Models\Publisher;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PublisherExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
    public function headings(): array
    {
        return [
            'Id',
            'Name (English)',
            'Name (Arabic)',
            'Created At',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Publisher::all();
    }

    public function map($publisher): array
    {
        return [
            $publisher->id,
            $publisher->getTranslation('name', 'en'),
            $publisher->getTranslation('name', 'ar'),
            $publisher->created_at,
        ];
    }
}
