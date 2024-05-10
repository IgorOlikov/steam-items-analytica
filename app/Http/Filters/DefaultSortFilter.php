<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DefaultSortFilter extends AbstractFilter
{
    public const SORT_BY_PRICE = 'sortByPrice';

    public const SORT_BY_NAME = 'sortByName';

    protected function getCallbacks(): array
    {
        return [
            self::SORT_BY_PRICE => [$this, 'sortByPrice'],
            self::SORT_BY_NAME => [$this, 'sortByName'],
        ];
    }

    public function sortByPrice(Builder $builder, $value): Builder
    {


        return $builder->orderBy('price', $value); // asc-desc
    }

    public function sortByName(Builder $builder, $value): Builder
    {
        return $builder->orderBy('name', $value);
    }


}
