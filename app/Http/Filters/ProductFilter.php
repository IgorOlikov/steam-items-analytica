<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    public const NAME = 'name';

    public const SLUG = 'slug';

    public const CATEGORY_ID = 'category_id';

    public const ID = 'id';

    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::SLUG => [$this, 'slug'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::ID => [$this, 'id'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name','LIKE',  "%${value}%");
    }
    public function slug(Builder $builder, $value)
    {
        $builder->where('slug','=', $value);
    }
    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id','=', $value);
    }
    public function id(Builder $builder, $value)
    {
        $builder->where('id','=',  $value);
    }



}
