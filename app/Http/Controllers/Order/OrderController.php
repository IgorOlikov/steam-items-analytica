<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderLine;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return response($orders,200);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $cart = $user->cart->first();

        $cartItems = $cart->cartItemsWithPrice()->get(['product_id', 'quantity', 'price']);

        foreach($cartItems as $item) {
            $amount[] =  $item['quantity'] * $item['price'];
        }

        $amount = array_sum($amount);

        $newOrder = Order::create([
             'user_id' => $user->id,
             'amount' => $amount,
             ]);

        $cartItemsArray = $cartItems->toArray();

        $timeStamp = Carbon::now();

        $orderId = $newOrder->id;

        $orderLines = array_map(function ($item) use ($newOrder, $timeStamp, $orderId) {
            unset($item['price']);
            $item['order_id'] = $orderId;
            $item['id'] = Uuid::uuid();
            $item['created_at'] = $timeStamp;
            $item['updated_at'] = $timeStamp;

            return $item;
        }, $cartItemsArray);

        OrderLine::insert($orderLines);

        CartItem::where('cart_id','=', $cart->id)->delete();

        //redirect to payment
        return response($newOrder, 201);
    }

    public function show(Order $order)
    {
        $order = $order->with('orderLines')->get();

        return response($order);
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
