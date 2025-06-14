<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class FlashSaleFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function flashsaleName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('name->en', 'LIKE', "%$name%")
                ->orWhere('name->ar', 'LIKE', "%$name%");
        });
    }

    public function flashsaleDescription($description)
    {
        return $this->where(function ($q) use ($description) {
            $q->where('description->en', 'LIKE', "%$description%")
                ->orWhere('description->ar', 'LIKE', "%$description%");
        });
    }
}
