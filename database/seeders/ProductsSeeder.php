<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductsSeeder extends Seeder
{

    public function run(): void
    {

        $products = require_once  'seeder-data/ProductArray.php';

        Product::insert($products);

    }
}
