<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;


class CategoryProductController extends Controller
{
    public function index(Request $request,Category $category)
    {
       //$products = (new FilterService($category))->filter()->get(['products.*','values']);

       $products  = $category->products();

       $products = $products->with('image')->get();

       dd($products);

        //add Resource APi collection! install debug-bar-package

        return response($products,200);
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
