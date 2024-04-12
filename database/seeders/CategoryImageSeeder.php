<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryImageSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $images  = array_diff(scandir(base_path() . '/public/main-catalog'), array('..', '.'));

        foreach ($images as $image) {
            $exp = explode('.', $image);

            $imagesArray[$exp[0]] = ['type' => $exp[1]];
        }

        foreach ($categories as $category) {
            $imageType = $imagesArray[$category['slug']]['type'];

            $category->image()->create(['url' => config('app.url') . '/main-catalog/' . $category['slug'] . '.' . $imageType]);
        }
    }

}
