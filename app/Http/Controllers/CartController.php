<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = auth()->user();

      //Image::insert([
      //    'id' => Uuid::uuid(),
      //    'imageable_type' => 'App\Models\Product',
      //    'imageable_id' => '9bc20386-c3ff-410f-8927-fc0e65de6f48',
      //    'url' => Str::random(10),
      //]);

      //$product = Product::first();

      //$product->load('images');

        $categories = Category::all();

       return response($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
