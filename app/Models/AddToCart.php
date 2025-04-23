<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    /** @use HasFactory<\Database\Factories\AddToCardFactory> */
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'quantity',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
