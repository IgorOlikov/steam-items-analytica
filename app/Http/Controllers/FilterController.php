<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isJson;

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
