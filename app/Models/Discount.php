<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'quantity',
        'precentage',
        'expiry_date',
    ];

    
}
