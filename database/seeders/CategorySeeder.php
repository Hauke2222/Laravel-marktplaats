<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         function createCategories() {
            $categories = array(
                'Meubels',
                'Sport',
                'Gereedschap',
                'Boeken',
                'Technologie',
                'Cultuur',
                'Overig'
             );

             foreach($categories as $category) {
                Category::create(['name' => $category]);
             }
         }
         createCategories();
    }
}
