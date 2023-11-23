<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    protected static function apply(Builder $query, $filter, $value): void
    {
        $method = 'filterBy' . ucfirst($filter);
        if (method_exists($query, $method)) {
            static::$method($query, $value);
        }
    }

    public static function applyFilters(Builder $query, array $filters): void
    {
        foreach ($filters as $filter => $value) {
            static::apply($query, $filter, $value);
        }
    }
}