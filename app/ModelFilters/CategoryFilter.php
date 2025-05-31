<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CategoryFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function categoryName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('categories.name->ar', 'LIKE', "%$name%")
                ->orWhere('categories.name->en', 'LIKE', "%$name%");
        });
    }

    public function discount($value)
    {
        if ($value) {
            return $this->whereNotNull('discount_id');
        } else {
            return $this->whereNull('discount_id');
        }
    }

    public function totalQuantitySoldFrom($value)
    {
        return $this->having('total_quantity_sold', '>=', $value);
    }

    public function totalQuantitySoldTo($value)
    {
        return $this->having('total_quantity_sold', '<=', $value);
    }
}
