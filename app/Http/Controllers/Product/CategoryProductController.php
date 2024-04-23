<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryProductController extends Controller
{

    private int $offset = 0;

    public function index(Request $request,Category $category)
    {
        $queryOffset = $request->query->get('offset');

        if (!is_null($queryOffset)) {
            $this->offset = $queryOffset;
        }

        try {
            $products = Product::where('category_id', $category->id)
                ->with('image')
                ->filter()
                ->offset($this->offset)
                ->take(10)
                ->get();

        } catch (\Exception $e) {
            //writeLog $E
            return response('Ничего не найдено',422);
        }

       return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request,Category $category, Product $product)
    {
        return response($product);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
