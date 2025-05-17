<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BookFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function bookName($name)
    {
        return $this->where(function ($q) use ($name) {
            $q->where('name->en', 'LIKE', "%$name%")
                ->orWhere('name->ar', 'LIKE', "%$name%");
        });
    }

    public function bookDescription($description)
    {
        return $this->where(function ($q) use ($description) {
            $q->where('description->en', 'LIKE', "%$description%")
                ->orWhere('description->ar', 'LIKE', "%$description%");
        });
    }

    public function category($value)
    {
        return $this->whereIn('category_id', $value);
    }

    public function publisher($value)
    {
        return $this->whereIn('publisher_id', $value);
    }
}
