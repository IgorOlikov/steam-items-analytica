<?php

namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     *
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder): Builder
    {
        $filters = [];

        $categoryFilters = require_once  base_path() . '/app/Http/Filters/CategoryFiltersArray.php';

        $filters[] = $categoryFilters['defaultProductFilter'];

        $filters[] = $categoryFilters[app()->request->route('category')->slug];

        $filters[] = $categoryFilters['defaultSortFilter'];


        foreach ($filters as $filter){

            (new $filter())->apply($builder);

        }

        return $builder;
    }


}
