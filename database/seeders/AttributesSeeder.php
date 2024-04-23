<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('slug','smartfony')->first();

        //'attributes -  jsonb col'


        $jsonb[] = [
            'brand' => 'Производитель',
            'screenDiagonal' => 'Диагональ экрана',
            'screenResolution' => 'Разрешение экрана',
            'os' => 'Операционная система',
            'memory' => 'Объем оперативной памяти',
            'cores' => 'Количество ядер'
        ];

        $arr = [];

        $arr['attributes'] = json_encode($jsonb);

        $category->attributes()->create($arr);


    }
}
