<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory, Filterable, HasTranslations;

    protected $fillable = [
        'name',
    ];

    public $translatable = ['name'];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
