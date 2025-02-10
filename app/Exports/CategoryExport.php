<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryExport implements FromCollection, WithHeadings, WithMapping
{
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
