<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{

    public function run(): void
    {
        $products = Product::all();

        $images  = array_diff(scandir(base_path() . '/public/products'), array('..', '.'));

        foreach ($images as $image) {
            $exp = explode('.', $image);

            $imagesArray[$exp[0]] = ['type' => $exp[1]];
        }

        foreach ($products as $product) {
            $imageType = $imagesArray[$product['slug']]['type'];

            $product->images()->create(['url' => config('app.url') . '/products/' . $product['slug'] . '.' . $imageType]);
        }
    }
}
