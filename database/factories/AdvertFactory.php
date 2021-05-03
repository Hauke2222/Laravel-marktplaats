<?php

namespace Database\Factories;

use App\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Faker;
use App\Models\ZipCode;

class AdvertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $contents = file_get_contents('https://source.unsplash.com/1600x900/?nature,forrest?'.rand(0,999));
        $randomNumber = time();
        $path = 'public/images/file_'.$randomNumber.'.jpg';
        Storage::put($path, $contents);

        $faker = Faker\Factory::create('nl_NL');

        return [
            'title' => $faker->sentence(10),
            'date' => '2020-08-04',
            'author' => 'Auteur',
            'zip_code_id' => ZipCode::inRandomOrder()->first()->id,
            'advert_description' => $faker->text(),
            'premium_advert' => (bool)rand(0,1),
            'user_id' => \App\Models\User::all()->random()->id,
            'image' => $path,
            //
        ];
    }
}
