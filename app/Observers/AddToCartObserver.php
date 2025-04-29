<?php

namespace App\Observers;

use App\Enum\InteractionTypsEnum;
use App\Models\AddToCart;

class AddToCartObserver
{
    public function creating(AddToCart $addToCart): void
    {
        $addToCart->interaction_type = InteractionTypsEnum::Cart;
    }
}
