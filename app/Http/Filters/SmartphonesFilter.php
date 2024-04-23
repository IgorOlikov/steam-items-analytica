<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class SmartphonesFilter extends AbstractFilter
{

    public const SLUG = 'slug';

    public const CATEGORY_ID = 'category_id';

    public const ID = 'product_id';

    protected function getCallbacks(): array
    {
        return [
            self::SLUG => [$this, 'slug'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::ID => [$this, 'productId'],
        ];
    }

    public function slug(Builder $builder, $value)
    {
        $builder->where('slug','=', $value);
    }
    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id','=', $value);
    }
    public function productId(Builder $builder, $value)
    {
        $builder->where('id','=',  $value);
    }


}
