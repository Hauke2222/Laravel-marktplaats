<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advert;
use App\Models\Category;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Advert::factory()->count(10)->create()->each(function ($advert) {
            $advert->categories()->sync(Category::inRandomOrder()->first()->id);
        });;

    }
}
