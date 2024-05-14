<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryFilterSeeder extends Seeder
{
    /**
     *  brand' => 'apple',
     * 'screenDiagonal' => 6.0,
     * 'screenResolution' => '1920x1080',
     * 'os' => 'ios',
     * 'memory' => 8,
     * 'cores' => 4,
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
                'filter' => 'screenDiagonal',
                'name' => 'Диагональ экрана',
                'filters' => [
                    [
                        'name' => '8.0',
                        'type' => 'checkbox',
                        'value' => '8.0'
                    ],
                    [
                        'name' => '7.0',
                        'type' => 'checkbox',
                        'value' => '7.0'
                    ],
                    [
                        'name' => '6.0',
                        'type' => 'checkbox',
                        'value' => '6.0'
                    ],
                    [
                        'name' => '5.0',
                        'type' => 'checkbox',
                        'value' => '5.0'
                    ],
                ]
            ],
            [
                'filter' => 'screenResolution',
                'name' => 'Разрешение экрана',
                'filters' => [
                    [
                        'name' => '3840x2160',
                        'type' => 'checkbox',
                        'value' => '3840x2160'
                    ],
                    [
                        'name' => '2560x1440',
                        'type' => 'checkbox',
                        'value' => '2560x1440'
                    ],
                    [
                        'name' => '1920x1080',
                        'type' => 'checkbox',
                        'value' => '1920x1080'
                    ],
                    [
                        'name' => '1280x1024',
                        'type' => 'checkbox',
                        'value' => '1280x1024'
                    ],
                ]
            ],
            [
                'filter' => 'os',
                'name' => 'Операционная система',
                'filters' => [
                    [
                        'name' => 'IoS',
                        'type' => 'checkbox',
                        'value' => 'ios'
                    ],
                    [
                        'name' => 'Android',
                        'type' => 'checkbox',
                        'value' => 'android'
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
            ],
            [
                'filter' => 'cores',
                'name' => 'Количество ядер',
                'filters' => [
                    [
                        'name' => '2',
                        'type' => 'checkbox',
                        'value' => '2'
                    ],
                    [
                        'name' => '4',
                        'type' => 'checkbox',
                        'value' => '4'
                    ],
                    [
                        'name' => '8',
                        'type' => 'checkbox',
                        'value' => '8'
                    ],
                ]
            ]
        ];

        Filter::create([
            'category_id' => $category->id,
            'filters' => json_encode($smartphoneFilters),
            ]);
    }
}
