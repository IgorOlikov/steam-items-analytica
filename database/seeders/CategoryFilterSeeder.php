<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('slug', '=', 'smartfony')->first();

        $smartphoneFilters = [
            [
                'filter' => 'brand',
                'name' => 'Производитель',
                'filters' => [
                     [
                         'name' => 'Apple',
                         'type' => 'checkbox',
                         'value' => 'apple'
                     ],
                     [
                         'name' => 'Samsung',
                         'type' => 'checkbox',
                         'value' => 'samsung'
                     ],
                     [
                         'name' => 'Xiaomi',
                         'type' => 'checkbox',
                         'value' => 'xiaomi'
                     ],
                     [
                         'name' => 'Realme',
                         'type' => 'checkbox',
                         'value' => 'realme'
                     ],
                     [
                         'name' => 'Honor',
                         'type' => 'checkbox',
                         'value' => 'honor'
                     ],
                     [
                         'name' => 'Tecno',
                         'type' => 'checkbox',
                         'value' => 'tecno'
                     ],
                     [
                         'name' => 'Poco',
                         'type' => 'checkbox',
                         'value' => 'poco'
                     ],
                     [
                         'name' => 'Infinix',
                         'type' => 'checkbox',
                         'value' => 'infinix'
                     ],
                ]
            ],
            [
                'filter' => 'memory',
                'name' => 'Оперативная память',
                'filters' => [
                    [
                        'name' => '1 Гб',
                        'type' => 'checkbox',
                        'value' => '1'
                    ],
                    [
                        'name' => '4 Гб',
                        'type' => 'checkbox',
                        'value' => '4'
                    ],
                    [
                        'name' => '8 Гб',
                        'type' => 'checkbox',
                        'value' => '8'
                    ],
                ]
            ]
        ];

        //dd($smartphoneFilters);


        $filter = Filter::create([
            'category_id' => $category->id,
            'filters' => json_encode($smartphoneFilters),
            ]);


    }
}
