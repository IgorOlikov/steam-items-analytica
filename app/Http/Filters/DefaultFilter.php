<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DefaultFilter extends AbstractFilter
{
    public const PRICE = 'price';

    public const BRAND = 'brand';

    public const NAME = 'name';

    protected function getCallbacks(): array
    {
        return [
            self::PRICE => [$this, 'price'],
            self::BRAND => [$this, 'brand'],
            self::NAME  => [$this, 'name'],
        ];
    }

    public function price(Builder $builder, $value): Builder
    {
        return $builder->whereBetween('price', $value);
    }

    public function name(Builder $builder, $value): Builder
    {
        return $builder->where('name','like', "%{$value[0]}%");
    }

    public function brand(Builder $builder, $value): Builder
    {
       return $builder->whereIn('attributes->brand', $value);
    }

}
