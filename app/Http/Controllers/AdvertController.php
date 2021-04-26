<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\Category;
use App\Models\ZipCode;
use App\Http\Requests\StoreAdvert;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $subQueries = [];

        if($request->has('zip') && strlen($request->get('zip') > 0)) {
            $zipCode = $request->zip;
            $zipCodeFromDatabase= DB::table('zip_codes')->where('postcode', '=', $zipCode)->first();
            $lat1 = $zipCodeFromDatabase->latitude;
            $lon1 = $zipCodeFromDatabase->longitude;
            $subQueries[] = "6371 * 2 * ATAN2( SQRT( POW( SIN( RADIANS( z.latitude - $lat1 )/2 ), 2 ) + COS( RADIANS( $lat1 ) ) * COS( RADIANS( z.latitude ) ) * POW( SIN( RADIANS( z.longitude - $lon1 ) / 2 ), 2 ) ), SQRT( 1 - POW( SIN( RADIANS( z.latitude - $lat1 )/2 ), 2 ) + COS( RADIANS( $lat1 ) ) * COS( RADIANS( z.latitude ) ) * POW( SIN( RADIANS( z.longitude - $lon1 ) / 2 ), 2 ) ) ) < $request->selectedDistance";
        }
        ($request->has('searchQuery')&& strlen($request->get('searchQuery')) > 0) ?  $subQueries[] = "title = '" . $request->input('searchQuery') ."'" : false;

        ($request->has('selectedCategory')&& strlen($request->get('selectedCategory')) > 0) ?  $subQueries[] = "ac.category_id = '" . $request->input('selectedCategory') ."'" : false;

        $query = "SELECT *, a.id as id FROM adverts a";
        if(count($subQueries) > 0) {
            $query .= " JOIN zip_codes z
            ON a.zip_code_id = z.id
            JOIN advert_categories ac
            ON ac.advert_id = a.id
            WHERE " . implode(" AND ", $subQueries);
        }
        $result = DB::raw($query);

        $ads = Advert::fromQuery($result, []);

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 4;

        $paginate = new \Illuminate\Pagination\LengthAwarePaginator(
            $ads->forPage($page, $perPage),
            $ads->count(),
            $perPage,
            $page,
            ['path' => url('adverts')]

        );
        return view('adverts.index', [
            'advertsFromDatabase' => $paginate,
            'categoriesFromDatabase' => Category::all()
            ]);
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
        unset($validated['zip_code']);
        $advert = Advert::create($validated);
        $advert->categories()->sync($request->categories);
        $advert->zipCode()->associate($zipCodeFromDatabaseId);
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
        $zipCodeFromInput = $request->zip_code;
        $zipCodeFromInput = substr($zipCodeFromInput, 0, -2);
        $zipCodeFromDatabase= DB::table('zip_codes')->where('postcode', '=', $zipCodeFromInput)->first();
        $zipCodeFromDatabaseId = $zipCodeFromDatabase->id;
        unset($validated['zip_code']);
        $advert->update($validated);
        $advert->categories()->sync($request->categories);
        $advert->zipCode()->associate($zipCodeFromDatabaseId);
        $advert->save();

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
