@extends ('layouts.app')

@section ('body')

<div class="container">
    <h1>{{ $advert->title }}</h1><p>Datum: {{ $advert->date }}</p>
    <p>Author: {{ $advert->author }}</p>
    <p>Postcode: {{ $advert->zipCode->postcode}}</p>
    <p>Bescrijving: {{ $advert->advert_description }}</p>
    <img src="{{Storage::url($advert->image)}}" class="img-fluid">

</div>


@endsection ('body')
