<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $category = Category::where('name','LIKE', '%Смартфоны')->get();

       $i = 1;
       while ($i <= 10){
        $category[0]->product()->create([
            'name' => $name = Str::random(),
            'price' => fake()->randomFloat(2,10),
            'slug' => Str::slug($name),
            ]);
        $i++;
        }
    }
}
