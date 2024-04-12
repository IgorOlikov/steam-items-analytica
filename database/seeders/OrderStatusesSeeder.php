<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            [
                'id' => 1,
                'status' => 'Создан'
            ],
            [
                'id' => 2,
                'status' => 'Оплачен'
            ],
            [
                'id' => 3,
                'status' => 'Доставлен'
            ]
        ];


        //dd($arr);

        OrderStatus::insert($arr);

    }
}
