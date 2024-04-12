<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItems = $cart->cartItems()->get(); // добавить агр функ взапрос (+price+). cart summary price column


        return response($cartItems);
    }

    //add product to cart
    public function store(Request $request)
    {
        // 'product id, quantity '
        $user = auth()->user();

        $cart = $user->cart()->first();

        //del price
        $cartItem = $cart->cartItems()->create([
            'product_id' => $request->validated('product_id'),
            ]);

        return response($cartItem,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // update product in cart
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
