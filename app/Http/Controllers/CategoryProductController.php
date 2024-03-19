<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\FilterService;
use Illuminate\Http\Request;


class CategoryProductController extends Controller
{
    public function index(Request $request,Category $category)
    {
       //$products = (new FilterService($category))->filter()->get(['products.*','values']);

        $products = $category->products()->get();


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
