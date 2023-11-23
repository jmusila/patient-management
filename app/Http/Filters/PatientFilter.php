<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PatientFilter
{
    use Filterable;

    public static function filterBySearch(Builder $query, $value)
    {
        return $query->whereRelation("user", function (Builder $query) use ($value) {
            $query->where("first_name", "like","%". $value ."%")
                ->orWhere("last_name","like","%". $value ."%")
                ->orWhere("middle_name", "like","%". $value ."%");
        });
    }

    public static function filterByEmail(Builder $query, $value): Builder
    {
        return $query->whereRelation("user", "email", "like", "%". $value ."%");
    }

    public static function filterByPhoneNumber(Builder $query, $value): Builder
    {
        return $query->whereRelation("user", "phone_number", "like", "%". $value ."%");
    }

    public static function filterByNationalIdNumber(Builder $query, $value): Builder
    {
        return $query->whereRelation("user", "national_id_number", "like", "%". $value ."%");
    }

    public static function filterByGender(Builder $query, $value): Builder
    {
        return $query->whereRelation("user", "gender", "like", "%". $value ."%");
    }

    public static function filters(Request $request): array
    {
        return $request->only([
            'email',
            'phone_number',
            'national_id_number',
            'gender',
            'search',
        ]);
    }
}