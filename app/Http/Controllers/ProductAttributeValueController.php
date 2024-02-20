<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $attributeValues = ProductAttributeValue::all();

       return response($attributeValues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $productAttributeValue = ProductAttributeValue::create([
            'product_id' => $request->input('product_id'),
            'product_attribute_id' => $request->input('product_attribute_id'),
            'values' => json_encode($request->input('values'))
        ]);

      return response($productAttributeValue,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
