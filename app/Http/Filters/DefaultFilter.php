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

    public function price(Builder $builder, $priceFrom, $priceTo)
    {
        $builder->whereBetween('price', [$priceFrom, $priceTo]);
    }

    public function name(Builder $builder, $name)
    {
        $builder->where('name','like', "%$name%");
    }

    public function brand(Builder $builder, $brand) // many brands params ? whereIn?
    {
        $builder->where('props->brand', $brand);
    }

}
