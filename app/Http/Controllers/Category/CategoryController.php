<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
       $productCategories = Category::whereNull('parent_id')->get();

        return response($productCategories,200);
    }

    public function store(Request $request)
    {
       $productCategory = Category::create($request->input());

       return response($productCategory,201);

    }

    public function show(Request $request, Category $category)
    {
        return response($category->childs,200);
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
