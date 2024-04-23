<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributesValueSeeder extends Seeder
{

    public function run(): void
    {
        //             'brand' => 'Производитель',
        //            'screenDiagonal' => 'Диагональ экрана',
        //            'screenResolution' => 'Разрешение экрана',
        //            'os' => 'Операционная система',
        //            'memory' => 'Объем оперативной памяти',
        //            'cores' => 'Количество ядер'

        $category = Category::where('slug','=','smartfony')->first();

        $product  = Product::where('category_id',$category->id)->first();

        //'attribute id'
        $attribute = Attribute::where('category_id', $category->id)->first();

        $attr = [
            'brand' => 'apple',
            'screenDiagonal' => 6.0,
            'screenResolution' => '1920x1080',
            'os' => 'ios',
            'memory' => 8,
            'cores' => 4,
        ];

        $arr = [
            'attribute_id' => $attribute->id,
            'attributes' => json_encode($attr),
        ];

        $product->attributes()->create($arr);

    }
}
