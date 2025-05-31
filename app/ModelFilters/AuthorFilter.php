<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AuthorFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function authorName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('authors.name->ar', 'LIKE', "%$name%")
                ->orWhere('authors.name->en', 'LIKE', "%$name%");
        });
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
