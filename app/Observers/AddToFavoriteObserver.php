<?php

namespace App\Observers;

use App\Enum\InteractionTypsEnum;
use App\Models\AddToFavorite;

class AddToFavoriteObserver
{
    public function creating(AddToFavorite $addToFavorite): void
    {
        $addToFavorite->interaction_type = InteractionTypsEnum::Favorite;
    }
}
