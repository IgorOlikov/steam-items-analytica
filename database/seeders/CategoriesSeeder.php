<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesList = require __DIR__ . '/seeder-data/CategoriesArray.php';
        $parentCategories = $categoriesList['parent_categories'];
        $childCategories = $categoriesList['child_categories'];
        $childOfChildCategories = $categoriesList['child_of_child_categories'];

        Category::insert($parentCategories);

        // fill child of parent categories

        $index = 0;
        foreach ($childCategories as $key => $child) {
            if ((($key % 2) === 0) && ($key !== 0)) {
                $index++;
            }
            $childCategories[$key]['parent_id'] = $parentCategories[$index]['id'];
        }
        Category::insert($childCategories);

        // fill child of child categories

        $index = 0;
        foreach ($childOfChildCategories as $key => $childOfChildCategory) {
            if ((($key % 2) === 0) && ($key !== 0)) {
                $index++;
            }
            $childOfChildCategories[$key]['parent_id'] = $childCategories[$index]['id'];
        }

         Category::insert($childOfChildCategories);
    }
}
