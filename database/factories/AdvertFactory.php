<?php

namespace Database\Factories;

use App\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;

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
/*         $contents = file_get_contents('https://source.unsplash.com/1600x900/?nature,forrest?'.rand(0,999));
        $randomNumber = time();
        $path = 'public/images/file_'.$randomNumber.'.jpg';
        Storage::put($path, $contents); */

        return [
            'title' => 'Advert title',
            'date' => '2020-08-04',
            'author' => 'Auteur',
            'zip_code' => 'Poscode 0000XX',
            'advert_description' => Str::random(75),
            'premium_advert' => false,
            'user_id' => \App\Models\User::all()->random()->id,
            'image' => 'path',
            //
        ];
    }
}
