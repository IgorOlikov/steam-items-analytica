<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $attributeValues = AttributeValue::all();

       return response($attributeValues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $productAttributeValue = AttributeValue::create([
            'product_id' => $request->input('product_id'),
            'attribute_id' => $request->input('attribute_id'),
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
