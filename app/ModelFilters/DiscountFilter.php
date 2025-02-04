<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class DiscountFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function discountCode($code)
    {
        return $this->where(function ($q) use ($code) {
            return $q->where('code', 'LIKE', "%$code%");
        });
    }
}
