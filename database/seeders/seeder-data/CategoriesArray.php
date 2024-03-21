<?php

use Faker\Provider\Uuid;
use Illuminate\Support\Str;

return [
   'parent_categories' => [
        [
            'id' => Uuid::uuid(),
            'name' => 'ПК и ноутбуки',
            'slug' => Str::slug('ПК и ноутбуки'),
            'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Смартфоны и планшеты',
             'slug' => Str::slug('Смартфоны и планшеты'),
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Комплектующие для ПК',
             'slug' => Str::slug('Комплектующие для ПК'),
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'ТВ, консоли и аудио',
             'slug' => Str::slug('ТВ, консоли и аудио'),
             'parent_id' => null,
         ],
         [
             'id' => Uuid::uuid(),
             'name' => 'Периферия для ПК и Ноутбуков',
             'slug' => Str::slug('Периферия для ПК и Ноутбуков'),
             'parent_id' => null,
         ],
        [
             'id' => Uuid::uuid(),
             'name' => 'Бытовая техника',
             'slug' => Str::slug('Бытовая техника'),
             'parent_id' => null,
         ],
    ],
    'child_categories' => [
        [
            'id' => Uuid::uuid(),
            'name' => 'Компьютеры и ПО',
            'slug' => Str::slug('Компьютеры и ПО'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Ноутбуки и аксессуары',
            'slug' => Str::slug('Ноутбуки и аксессуары'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смартфоны и гаджеты',
            'slug' => Str::slug('Смартфоны и гаджеты'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Планшеты, электронные книги',
            'slug' => Str::slug('Планшеты, электронные книги'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Основные комплектующие для ПК',
            'slug' => Str::slug('Основные комплектующие для ПК'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Устройства расширения',
            'slug' => Str::slug('Устройства расширения'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Телевизоры и аксессуары',
            'slug' => Str::slug('Телевизоры и аксессуары'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Консоли и видеоигры',
            'slug' => Str::slug('Консоли и видеоигры'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Периферия для ноутбуков',
            'slug' => Str::slug('Периферия для ноутбуков'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Периферия для ПК',
            'slug' => Str::slug('Периферия для ПК'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Для кухни',
            'slug' => Str::slug('Для кухни'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Для дома',
            'slug' => Str::slug('Для дома'),
            'parent_id' => null,
        ],
    ],
    'child_of_child_categories'=> [
        [
            'id' => Uuid::uuid(),
            'name' => 'Персональные компьютеры',
            'slug' => Str::slug('Персональные компьютеры'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Моноблоки',
            'slug' => Str::slug('Моноблоки'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Ноутбуки',
            'slug' => Str::slug('Ноутбуки'),
            'parent_id' => null,
        ],[
            'id' => Uuid::uuid(),
            'name' => 'Рюкзаки для ноутбуков',
            'slug' => Str::slug('Рюкзаки для ноутбуков'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смартфоны',
            'slug' => Str::slug('Смартфоны'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Смарт часы',
            'slug' => Str::slug('Смарт часы'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Планшеты',
            'slug' => Str::slug('Планшеты'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Электронные книги',
            'slug' => Str::slug('Электронные книги'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Видеокарты',
            'slug' => Str::slug('Видеокарты'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Процессоры',
            'slug' => Str::slug('Процессоры'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Оптические приводы',
            'slug' => Str::slug('Оптические приводы'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Звуковые карты',
            'slug' => Str::slug('Звуковые карты'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Телевизоры',
            'slug' => Str::slug('Телевизоры'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Пульты',
            'slug' => Str::slug('Пульты'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'PlayStation',
            'slug' => Str::slug('PlayStation'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Видеоигры',
            'slug' => Str::slug('Видеоигры'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Зарядные устройства для ноутбуков',
            'slug' => Str::slug('Зарядные устройства для ноутбуков'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Блоки питания для ноутбуков',
            'slug' => Str::slug('Блоки питания для ноутбуков'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Мониторы для ПК',
            'slug' => Str::slug('Мониторы для ПК'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Клавиатуры для ПК',
            'slug' => Str::slug('Клавиатуры для ПК'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Микроволновые печи',
            'slug' => Str::slug('Микроволновые печи'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Холодильники',
            'slug' => Str::slug('Холодильники'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Стиральные машины',
            'slug' => Str::slug('Стиральные машины'),
            'parent_id' => null,
        ],
        [
            'id' => Uuid::uuid(),
            'name' => 'Утюги',
            'slug' => Str::slug('Утюги'),
            'parent_id' => null,
        ],
    ]

];
