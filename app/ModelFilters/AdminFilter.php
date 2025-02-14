<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AdminFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function adminName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('name', 'LIKE', "%$name%");
        });
    }

    public function adminEmail($email)
    {
        return $this->where(function ($q) use ($email) {
            $q->where('email', 'LIKE', "%$email%")
                ->orWhere('email', 'LIKE', "%$email%");
        });
    }
}
