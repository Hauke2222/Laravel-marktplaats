<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZipCode;

class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        function seedZipCodes() {

            include('database/seeders/zip_code.php');

            foreach($zipCodes as $zipCode) {
                ZipCode::create([
                    'id' => $zipCode['id'],
                    'postcode' => $zipCode['postcode'],
                    'woonplaats' => $zipCode['woonplaats'],
                    'alternatieve_schrijfwijzen' => $zipCode['alternatieve_schrijfwijzen'],
                    'gemeente' => $zipCode['gemeente'],
                    'provincie' => $zipCode['provincie'],
                    'netnummer' => $zipCode['netnummer'],
                    'latitude' => $zipCode['latitude'],
                    'longitude' => $zipCode['longitude'],
                    'soort' => $zipCode['soort'],
                    ]);

             }
         }
         seedZipCodes();
        }
}
