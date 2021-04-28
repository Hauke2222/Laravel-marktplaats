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
        $contents = file_get_contents('https://source.unsplash.com/1600x900/?nature,forrest?'.rand(0,999));
        $randomNumber = time();
        $path = 'public/images/file_'.$randomNumber.'.jpg';
        Storage::put($path, $contents);

        return [
            'title' => 'Advert title',                          // todo: laat de faker willekeurige titles genereren zodat je het zoeken op title beter kunt testen
            'date' => '2020-08-04',
            'author' => 'Auteur',
            'zip_code_id' => '11',                              // todo: kies een random zipcode
            'advert_description' => Str::random(75),            // todo: hier kun je een faker functie voor gebruiken om een iets realistischere description te maken
            'premium_advert' => false,                          // todo: deze waarde kun je randomizen
            'user_id' => \App\Models\User::all()->random()->id,
            'image' => $path,
            //
        ];
    }
}
