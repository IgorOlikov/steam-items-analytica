<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItem;
use App\Http\Requests\UpdateCartItem;
use App\Http\Requests\CartPacketStoreRequest;
use App\Http\Resources\CartItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $cart = $user->cart()->first();

        $cartItems = $cart->cartItems()->with(['image','product'])->get();

        return CartItemResource::collection($cartItems);
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

    public function packetStore(CartPacketStoreRequest $request)
    {
        $syncCartItems = $request->validated();

        $user = auth()->user();

        $cart = $user->cart()->first();

        $userCartItems = $cart->cartItems()->get('product_id as id');

        $userCartItems = $userCartItems->toArray();

        $cartItemsDiff = array_map(
            'unserialize',
            array_diff(
                array_map('serialize', $syncCartItems),
                array_map('serialize', $userCartItems)
            ));

        if(!empty($cartItemsDiff)) {
            $newCartItems = array_map(function ($arr) {
                $arr['product_id'] = $arr['id'];
                unset($arr['id']);
                return $arr;
            } ,$cartItemsDiff);

           $cart->cartItems()->createMany($newCartItems);

           $cartItems = $cart->cartItems()->get();

           return CartItemResource::collection($cartItems);
        }
        return response('cart sync', 422);
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
