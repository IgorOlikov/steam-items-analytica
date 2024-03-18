<?php

use Faker\Provider\Uuid;

return [
   'parent_categories' => [
        [
            'id' => Uuid::uuid(),
            'name' => 'ПК и ноутбуки',
            'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Смартфоны и планшеты',
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Комплектующие для ПК',
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'ТВ, консоли и аудио',
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Периферия для ПК и Ноутбуков',
             'parent_id' => null,
         ],
        [
              'id' => Uuid::uuid(),
             'name' => 'Бытовая техника',
             'parent_id' => null,
         ],
    ],
    'child_categories' => [
        [
            'id' => Uuid::uuid(),
            'name' => 'Компьютеры и ПО',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Ноутбуки и аксессуары',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смартфоны и гаджеты',
            'parent_id' => null,
        ],[
            'id' => Uuid::uuid(),
            'name' => 'Планшеты, электронные книги',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Основные комплектующие для ПК',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Устройства расширения',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Телевизоры и аксессуары',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Консоли и видеоигры',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Периферия для ноутбуков',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Периферия для ПК',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Для кухни',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Для дома',
            'parent_id' => null,
        ],
    ],
    'child_of_child_categories'=> [
        [
            'id' => Uuid::uuid(),
            'name' => 'Персональные компьютеры',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Моноблоки',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Ноутбуки',
            'parent_id' => null,
        ],[
            'id' => Uuid::uuid(),
            'name' => 'Рюкзаки для ноутбуков',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смартфоны',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смарт часы',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Планшеты',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Электронные книги',
            'parent_id' => null,
        ],

        [
            'id' => Uuid::uuid(),
            'name' => 'Видеокарты',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Процессоры',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Оптические приводы',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Звуковые карты',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Телевизоры',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Пульты',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'PlayStation',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Видеоигры',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Зарядные устройства для ноутбуков',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Блоки питания для ноутбуков',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Мониторы для ПК',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Клавиатуры для ПК',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Микроволновые печи',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Холодильники',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Стиральные машины',
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Утюги',
            'parent_id' => null,
        ],
    ]

];
