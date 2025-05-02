<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    /** @use HasFactory<\Database\Factories\BookOrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'price',
        'quantity',
    ];
}
