<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Database\Seeder;



class ProductsSeeder extends Seeder
{

    public function run(): void
    {

        $products = require_once  'seeder-data/ProductArray.php';

        $productAttributes = require_once 'seeder-data/ProductAttributeArray.php';

        $categoryId  = $products[0]['category_id'];

        $attribute = Attribute::where('category_id', '=', $categoryId)->first();

        $attributeId = $attribute->id;


        foreach ($products as $key => $product) {
           $product = Product::create($product);

           AttributeValue::create([
               'product_id' => $product->id,
               'attribute_id' => $attributeId,
               'attributes' => json_encode($productAttributes[$key], JSON_PRESERVE_ZERO_FRACTION),
               ]);
        }

    }
}
