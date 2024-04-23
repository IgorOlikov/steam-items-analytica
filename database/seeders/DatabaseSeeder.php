<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
            OrderStatusesSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            CategoryImageSeeder::class,
            ProductImageSeeder::class,
            AttributesSeeder::class,
        ]);




        //User::factory()->create();


        //Product::factory(30)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
