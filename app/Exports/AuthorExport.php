<?php

namespace App\Exports;

use App\Models\Author;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AuthorExport implements FromCollection , WithHeadings, WithMapping
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
        return Author::all();
    }

    public function map($author): array
    {
        return [
            $author->id,
            $author->getTranslation('name', 'en'),
            $author->getTranslation('name', 'ar'),
            $author->created_at,
        ];
    }
}
