<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\Category;
use App\Http\Requests\StoreAdvert;
use Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Advert::create($validated)->categories()->sync($request->categories);

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
        return view('adverts.edit',  ['advert' => $advert, 'advertCategoriesFromDatabase' => Category::all(), 'selectedCategories' => $advert->categories]);
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
