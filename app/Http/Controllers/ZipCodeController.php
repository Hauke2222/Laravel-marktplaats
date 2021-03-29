<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ITITIAL POINT
        $cordinates = array('latitude' => $zipCode->latitude, 'longitude' => $zipCode->longitude);
        //RADIUS
        $radius = 0;

        DB::table('zip_codes')
            ->select(DB::raw(
        SELECT id, (
           3959 * acos (
           cos ( radians(78.3232) )
           * cos( radians( lat ) )
           * cos( radians( lng ) - radians(65.3234) )
           + sin ( radians(78.3232) )
           * sin( radians( lat ) )
           )
       ) AS distance
       FROM markers
       HAVING distance < 30
       ORDER BY distance)->get()


    }
}
