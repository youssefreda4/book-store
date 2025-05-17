<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use Filterable, HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
    ];

    public function books()
    {

        return $this->hasMany(Book::class);
    }
}
