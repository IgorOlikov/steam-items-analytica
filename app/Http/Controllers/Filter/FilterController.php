<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Filter::all();

        return response($filters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd(json_encode($request->input('filters')));

         $filter = Filter::create([
             'category_id' => $request->input('category_id'),
             'filters' => json_encode($request->input('filters'))
         ]);

         return response($filter,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $string)
    {
        $category = Category::where('slug','=', $string)->first();

        $filter = $category->productFilter()->pluck('filters')[0];

        return response(json_decode($filter,true));
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
