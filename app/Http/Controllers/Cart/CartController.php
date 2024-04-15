<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItem;
use App\Http\Requests\UpdateCartItem;

class CartController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItems = $cart->cartItems()->get(); // добавить агр функ взапрос (+price+). cart summary price column

        return response($cartItems);
    }

    public function store(StoreCartItem $request)
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItem = $cart->cartItems()->create([
            'product_id' => $request->validated('product_id'),
            ]);

        return response($cartItem,201);
    }

    public function show(string $id)
    {
        //
    }

    public function update(UpdateCartItem $request, string $productId)
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItem = $cart->cartItems()->where('product_id','=',$productId)->first();

        $cartItemUpdated = $cartItem->update(['quantity' => $request->validated('quantity')]);

        return $cartItemUpdated
            ? response(['message' => 'Successfully updated'],200)
            : response(['message' => 'Update error'],422);
    }

    public function destroy(string $productId)
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItemDeleted = $cart->cartItems()->where('product_id','=',$productId)->delete();

        return $cartItemDeleted
            ? response(['message' => 'Successfully deleted'],200)
            : response(['message' => 'Delete error'],422);
    }
}
