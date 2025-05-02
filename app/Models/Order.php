<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'number',
        'shipping_fee',
        'books_total',
        'total',
        'status',
        'payment_status',
        'payment_type',
        'tax_amount',
        'transaction_reference',
        'address',
        'shipping_area_id',
        'user_id',
    ];
}
