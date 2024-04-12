<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function catalogMenu()
    {
        $categories = Category::whereNull('parent_id')
                    ->with('categories')->get();

        //$categories = Category::whereNull('parent_id')
        //    ->with('image')->get();


        return response($categories,200);
    }

    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->join('images','categories.id','=','images.imageable_id')
            ->with(['categories'])
            ->get(['categories.*', 'images.url as image']);

        return response($categories,200);
    }


    public function showCatalogCategory(Request $request,Category $category)
    {
        $categories = Category::where('parent_id','=',$category->id)
            ->join('images','categories.id','=','images.imageable_id')
            ->with('categories')
            ->get(['categories.*', 'images.url as image']);

        return response($categories);
    }

    public function store(Request $request)
    {
        //
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
