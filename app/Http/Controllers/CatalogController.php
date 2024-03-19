<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function catalogMenu()
    {
        $categories = Category::whereNull('parent_id')
            ->with('categories')->get();

        return response($categories,200);
    }

    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('categories')->get();

        return response($categories,200);
    }


    public function showCatalogCategory(Request $request,Category $category)
    {
        $categories = Category::where('parent_id','=',$category->id)
            ->with('categories')->get();

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
