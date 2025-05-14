<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ShippingAreaFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function areaName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('name->ar', 'LIKE', "%$name%")
                ->orWhere('name->en', 'LIKE', "%$name%");
        });
    }

    public function areaFee($value)
    {
        return $this->where(function ($q) use ($value) {
            $q->where('fee', '=', $value);
        });
    }
}
