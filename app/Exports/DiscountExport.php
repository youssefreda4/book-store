<?php

namespace App\Exports;

use App\Models\Discount;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DiscountExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F81BD']],
                'alignment' => ['horizontal' => 'center']
            ],

            'B' => ['font' => ['size' => 14, 'color' => ['rgb' => '333333']]],

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
        return Discount::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Code',
            'Quantity',
            'Precentage',
            'Expiry Date',
            'Create At',
        ];
    }

    public function map($discount): array
    {
        return [
            $discount->id,
            $discount->code,
            $discount->quantity,
            $discount->precentage,
            $discount->expiry_date,
            $discount->created_at,
        ];
    }
}
