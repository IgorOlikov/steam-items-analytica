<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->load('attributeValue');

       //$products = DB::table('product_attribute_values')->whereJsonContains('values->Цвет','Белый')->get();



        return response($products,200);
    }

    public function store(Request $request)
    {
       $product = Product::create($request->input());

       return response($product);
    }

    public function show(string $id)
    {
        //
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
