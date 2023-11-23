<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    protected static function applyFilter(Builder $query, $filter, $value)
    {
        $method = 'filterBy' . underscoreToCamelCase($filter);
        if (method_exists(static::class, $method)) {
            static::$method($query, $value);
        }
    }

    public static function applyFilters(Builder $query, array $filters)
    {
        foreach ($filters as $filter => $value) {
            static::applyFilter($query, $filter, $value);
        }
    }

    public static function applyTo(Builder $query, array $filters)
    {
        static::applyFilters($query, $filters);
    }
}