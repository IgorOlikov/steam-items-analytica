<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class CategoryProductController extends Controller
{



    public function index(Request $request,Category $category)
    {
        //dd($request->query);

        //cursor paginate?
        //try {
            $products = Product::where('category_id', $category->id)
                ->with(['image'])
                ->filter()
                ->offset($request->offset ?? 0)
                ->take(10)
                ->get();

        //} catch (\Exception $e) {
        //    //writeLog $E
        //    return response($e,422);
        //}

        //return response($products);

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
