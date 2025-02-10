<?php

namespace App\Exports;

use App\Models\Publisher;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PublisherExport implements FromCollection, WithHeadings, WithMapping
{
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
