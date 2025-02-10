<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlashSale extends Model
{
    /** @use HasFactory<\Database\Factories\FlashSaleFactory> */
    use HasFactory, Filterable, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'is_active',
        'start_time',
        'percentage'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    

    public $translatable = ['name', 'description'];
}
