<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory, Filterable;

    protected $fillable = [
        'code',
        'quantity',
        'percentage',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function books()
    {
        return $this->morphMany(Book::class, 'discountable');
    }
}
