<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use Filterable, HasFactory, HasTranslations;

    protected $fillable = [
        'name',
    ];

    public $translatable = ['name'];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
