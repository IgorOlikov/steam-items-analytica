<?php

namespace App\Http\Filters;

use App\Models\Attribute;
use App\Models\AttributeValue;
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
        return $builder->where('name','like', "%{$value}%");
    }

    public function brand(Builder $builder, $value): Builder
    {
       return $builder->whereHas('attributes', function ($query) use ($value) {
                $query->whereIn('attributes->brand', $value);
        });
    }

}
