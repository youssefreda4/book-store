<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FlashSale extends Model
{
    /** @use HasFactory<\Database\Factories\FlashSaleFactory> */
    use Filterable, HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'start_time',
        'is_active',
        'percentage',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

    public $translatable = ['name', 'description'];

    public function isActive()
    {
        if ($this->is_active) {
            return '<span class="badge bg-success rounded">'.__('flashsale.active').'</span>';
        }

        return '<span class="badge bg-danger rounded">'.__('flashsale.not_active').'</span>';
    }

    public function books()
    {
        return $this->morphMany(Book::class, 'discountable');
    }
}
