<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory,Filterable;

    protected $fillable = [
        'code',
        'quantity',
        'precentage',
        'expiry_date',
    ];

    
}
