<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderLine;
use Faker\Provider\Uuid;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = $user->orders()->get();

        return response($orders,200);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $cart = $user->cart->first();

        $cartItems = $cart->cartItemsWithPrice()->get(['product_id', 'quantity', 'price']);

        foreach($cartItems as $item) {
            $amount[] = $item['quantity'] * $item['price'];
        }

        $amount = array_sum($amount);

        DB::beginTransaction();

        try {

            $newOrder = Order::create([
                'user_id' => $user->id,
                'amount' => $amount,
            ]);

            $cartItemsArray = $cartItems->toArray();

            $orderLines = array_map(function ($cartItem) use ($newOrder) {
                unset($cartItem['price']);
                return $cartItem;
            }, $cartItemsArray);

            $newOrder->orderLines()->createMany($orderLines);

            //send order to payment service
            //$client = new Client();
            //$response = $client->request('');


        } catch (\Exception $e) {
            //log write error
            DB::rollBack();

            return response($e,422);
        }

        //send order to payment service?

        //redirect to payment

        DB::commit();

        //empty cart
        CartItem::where('cart_id', '=', $cart->id)->delete();


        //
        //    $merchant_id = '7012';
        //    $secret_word = 'secret';
        //    $order_id = '154';
        //    $order_amount = '100.11';
        //    $currency = 'RUB';
        //    $sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$currency.':'.$order_id);
        //

        return response($newOrder, 201)->redirectTo('/');
    }

    public function orderWebhook(Request $request)
    {
        //check sign
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->user()->id) {
            return response('Пользователь не имеет доступ',403);
        }

        $order = $order->with('orderLines')->get();

        return response($order);
    }

    public function update(Request $request, Order $order)
    {
        if (auth()->user()->role_id !== 1) {
            return response('Пользователь не имеет доступ',403);
        }
        return response('lol?');
    }

    public function destroy(string $id)
    {
        //
    }
}
