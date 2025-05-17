<?php

namespace App\Models;

use App\Enum\InteractionTypsEnum;
use App\Models\Scopes\AddToFavoriteScope;
use App\Observers\AddToFavoriteObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([AddToFavoriteObserver::class])]
#[ScopedBy([AddToFavoriteScope::class])]
class AddToFavorite extends Model
{
    /** @use HasFactory<\Database\Factories\AddToFavoriteFactory> */
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
        return $this->belongsTo(User::class);
    }
}
