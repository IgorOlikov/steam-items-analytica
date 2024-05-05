<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class OrderWebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!in_array($this->ip(), ['68.119.157.136', '168.119.60.227', '178.154.197.79', '51.250.54.238'])) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'MERCHANT_ORDER_ID' => 'required|string', // ID заказа в интернет магазине
            'AMOUNT' => 'required|string',  // Сумма
            'SIGN' => 'required|string',    // Подпись
            'MERCHANT_ID' => '',            // ID Вашего магазина
            'intid' =>  '',                 // Номер операции Free-Kassa
            'P_EMAIL' => 'email',           //'Email плательщика',
            'P_PHONE' => '',                //Телефон плательщика (если указан)
            'CUR_ID' => '',	                //ID электронной валюты, который был оплачен заказ список валют
            'us_key' => '',	                //Дополнительные параметры с префиксом us_, переданные в форму оплаты
            'payer_account' => '',	        //Номер счета/карты плательщика
            'commission' => '', 	        //Сумма комиссии в валюте платежа

        ];
    }
}
