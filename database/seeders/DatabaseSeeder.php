<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           CategoriesSeeder::class,
        ]);
        //User::factory()->create();

        //$product = require __DIR__ . '/seeder-data/ProductArray.php';
        //dd($product);

        //$categories = require __DIR__ . '/seeder-data/CategoriesArray.php';
        //dd($categories);

        //Product::factory(30)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
