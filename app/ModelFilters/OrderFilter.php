<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function orderNumber($number)
    {
        return $this->where('number', 'LIKE', "%$number%");
    }

    public function orderStatus($status)
    {
        return $this->where('status', 'LIKE', "%$status%");
    }

    public function paymentStatus($status)
    {
        return $this->where('payment_status', 'LIKE', "%$status%");
    }

    public function paymentType($type)
    {
        return $this->where('payment_type', 'LIKE', "%$type%");
    }

    public function userName($name)
    {
        return $this->whereHas('user', function ($q) use ($name) {
            $q->where('first_name', 'LIKE', "%$name%")
                ->orWhere('last_name', 'LIKE', "%$name%");
        });
    }

    public function shippingAreaName($name)
    {
        return $this->whereHas('shippingArea', function ($q) use ($name) {
            $q->where('name->en', 'LIKE', "%$name%")
                ->orWhere('name->ar', 'LIKE', "%$name%");
        });
    }
}
