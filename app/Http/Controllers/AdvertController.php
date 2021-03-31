<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\Category;
use App\Models\ZipCode;
use App\Http\Requests\StoreAdvert;
use Auth;
use DB;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->has('zip')) {
        // todo: breid query uit met WHERE? om te filteren op GPS locatie
        $query = "SELECT * FROM adverts a
        JOIN zip_codes z
        ON a.zip_code_id = z.id

        SET a = POW( SIN( RADIANS( lat2 - lat1 )/2 ), 2 ) + COS( RADIANS( lat1 ) ) * COS( RADIANS( lat2 ) ) * POW( SIN( RADIANS( lon2 - lon1 ) / 2 ), 2 );
        SET c = 2 * ATAN2( SQRT( a ), SQRT( 1 - a ) );
        SET dist = r * c;

        WHERE dist < selectedRange


        ";
        $result = DB::raw($query);

        $ads = Advert::fromQuery($result, []);

        return view('adverts.index');

            } else

        return view('adverts.index', ['advertsFromDatabase' => Advert::orderBy('date', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adverts.create', ['advertCategoriesFromDatabase' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvert $request)
    {
        //
        $validated = $request->validated();
        $validated['premium_advert'] = $request->has('premium_advert');
        if ($validated['image'] = $request->has('image')){
            $validated['image'] = $request->file('image')->store('public/images');
        }
        $zipCodeFromInput = $request->zip_code;
        $zipCodeFromInput = substr($zipCodeFromInput, 0, -2);
        $zipCodeFromDatabase= DB::table('zip_codes')->where('postcode', '=', $zipCodeFromInput)->first();
        $zipCodeFromDatabaseId = $zipCodeFromDatabase->id;
        //Advert::create($validated)->categories()->sync($request->categories);
        $advert = Advert::create($validated);
        $advert->zipCode()->associate($zipCodeFromDatabaseId);
        //dd($advert);
        $advert->save();

        return redirect()->route('adverts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        //
        return view('adverts.show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        //
        return view('adverts.edit',
        [
            'advert' => $advert,
            'advertCategoriesFromDatabase' => Category::all(),
            'selectedCategories' => $advert->categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdvert $request, Advert $advert)
    {
        //
        $validated = $request->validated();
        $validated['premium_advert'] = $request->has('premium_advert');
        if ($validated['image'] = $request->has('image')){
            $validated['image'] = $request->file('image')->store('public/images');
        }
        $advert->update($validated);
        $advert->categories()->sync($request->categories);

        return redirect()->route('adverts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        //
        $advert->delete();
        return redirect()->route('adverts.index');
    }
}
