<?php

namespace App\Exports;

use App\Models\Discount;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DiscountExport implements FromCollection, WithHeadings, WithMapping
{
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
