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
        Category::create([
            'name' => 'Meubels'
         ]);
         Category::create([
             'name' => 'Sport'
          ]);
         Category::create([
             'name' => 'Gereedschap'
          ]);
         Category::create([
             'name' => 'Boeken'
          ]);
         Category::create([
             'name' => 'Technologie'
          ]);
         Category::create([
             'name' => 'Cultuur'
          ]);
          Category::create([
            'name' => 'Overig'
         ]);
    }
}
