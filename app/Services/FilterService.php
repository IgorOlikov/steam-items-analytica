<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilterService
{

    public function __construct(
        private readonly Category $category
    )
    {
    }

    public function filter() : QueryBuilder
    {
        $query = QueryBuilder::for(Product::class)
            ->where('category_id',$this->category->id)
            ->join('attribute_values','products.id','=','attribute_values.product_id');

        return $this->applyFilters($query);
    }

    public function applyFilters(QueryBuilder $queryBuilder): QueryBuilder
    {
        $filters = $this->getFilterScopes();

        return $queryBuilder->allowedFilters($filters);
    }

    public function getFilterScopes(): array
    {
       $filterScopes = json_decode(Filter::where('category_id','=',$this->category->id)
            ->value('filters'));

       foreach ($filterScopes as $scope) {
            $scopes[] = AllowedFilter::scope($scope);
        }

       return $scopes;
    }


}
