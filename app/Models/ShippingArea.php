<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ShippingArea extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAreaFactory> */
    use HasFactory, Filterable, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'fee',
    ];
}
