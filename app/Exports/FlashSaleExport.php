<?php

namespace App\Exports;

use App\Models\FlashSale;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FlashSaleExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            'Is_active',
            'Date',
            'Time',
            'Created At',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return FlashSale::all();
    }

    public function map($flash_sale): array
    {
        return [
            $flash_sale->id,
            $flash_sale->getTranslation('name', 'en'),
            $flash_sale->getTranslation('name', 'ar'),
            $flash_sale->getTranslation('description', 'en'),
            $flash_sale->getTranslation('description', 'ar'),
            $flash_sale->is_active,
            $flash_sale->date,
            $flash_sale->time,
            $flash_sale->created_at,
        ];
    }
}
