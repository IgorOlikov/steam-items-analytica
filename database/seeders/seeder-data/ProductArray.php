<?php

use App\Models\Category;
use Faker\Provider\Uuid;
use Illuminate\Support\Carbon;


$category = Category::where('slug','=', 'smartfony')->first();
$categoryId = $category->id;

$timeStamp = Carbon::now();

return [
    [
      //'id' => Uuid::uuid(),
      'name' =>  $slug = 'Apple iPhone 15 Pro Max 256 ГБ серый',
      'slug' => \Illuminate\Support\Str::slug($slug),
      'price' => fake()->randomFloat(2,7),
      'category_id' => $categoryId,
      //'created_at' => $timeStamp,
      //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Apple iPhone 15 128 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Apple iPhone 15 Pro 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Apple iPhone 13 128 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi Redmi 12 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Samsung Galaxy S24 Ultra 512 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Samsung Galaxy S23 Ultra 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi Redmi Note 12 Pro+ 256 ГБ голубой',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Samsung Galaxy S21 FE 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi 13T 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Samsung Galaxy A54 5G 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Tecno POVA 5 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi Redmi A2+ 64 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Infinix NOTE 30 Pro 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi Redmi 12C 128 ГБ серый',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Samsung Galaxy S24 Ultra 512 ГБ фиолетовый',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Honor 90 512 ГБ зеленый',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Xiaomi Redmi 12C 64 ГБ серый',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Infinix NOTE 30 256 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Poco X6 Pro 512 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Huawei P60 Pro 512 ГБ белый',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
    [
        //'id' => Uuid::uuid(),
        'name' =>  $slug = 'Realme Note 50 64 ГБ черный',
        'slug' => \Illuminate\Support\Str::slug($slug),
        'price' => fake()->randomFloat(2,7),
        'category_id' => $categoryId,
        //'created_at' => $timeStamp,
        //'updated_at' => $timeStamp,
    ],
];
