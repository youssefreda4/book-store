<?php

namespace App\Models;

use App\Enum\InteractionTypsEnum;
use App\Models\Scopes\AddToCartScope;
use App\Observers\AddToCartObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([AddToCartObserver::class])]
#[ScopedBy([AddToCartScope::class])]
class AddToCart extends Model
{
    /** @use HasFactory<\Database\Factories\AddToCardFactory> */
    use HasFactory;

    protected $table = 'book_interactions';

    protected $fillable = [
        'book_id',
        'user_id',
        'quantity',
        'interaction_type',
    ];

    protected $casts = [
        'interaction_type' => InteractionTypsEnum::class,
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
