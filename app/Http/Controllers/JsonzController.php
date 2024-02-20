<?php

namespace App\Http\Controllers;

use App\Models\Jsonz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JsonzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $row = DB::table('jsonz')
            ->whereJsonContains('content->Бренд','Интел')
            ->get();

       return response($row);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $jsonz = Jsonz::create([
               'content' => json_encode($request->input('content'))
           ]);

            return response($jsonz);

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
