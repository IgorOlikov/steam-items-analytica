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
       $products = (new FilterService($category))->filter()->get(['products.*','values']);

        return response($products);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request,Category $category, Product $product)
    {
        dd($category,$product);
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
