<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryProductController extends Controller
{
    public function index(Request $request,Category $category)
    {
        //$products = (new FilterService($category))->filter()->get(['products.*','values']);

        $products  = $category->products();

        $products = $products->with('image')->get();

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
