<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $productCategories = ProductCategory::all();

        return response($productCategories,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $productCategory = ProductCategory::create($request->input());

       return response($productCategory,201);

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
