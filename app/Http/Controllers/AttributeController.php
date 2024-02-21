<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $productAttributes = Attribute::all();

       return response($productAttributes,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $productAttribute = Attribute::create([
           'product_category_id' => $request->input('product_category_id'),
           'attributes' => json_encode($request->input('attributes'))
       ]);

        return response($productAttribute);
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
