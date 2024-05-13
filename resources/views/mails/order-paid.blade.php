<div>
    <div>
        <p>Здравствуйте {{ $user->name }}</p>
        <p>Заказ № {{ $order->id }} на сумму {{ $order->amount }} рублей, успешно оплачен!</p>
    </div>
    <div>
        <a href="{{ config('app.url') . "/api/v1/order/$order->id" }}">
        <button>Информация о заказе</button>
        </a>
    </div>
</div>
