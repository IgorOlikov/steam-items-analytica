<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        //return response(auth()->getToken());

        return response()->json(auth()->user());
    }
}
