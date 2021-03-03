@extends ('layouts.app')

@section ('body')

advertid: {{$advert->id}}
<?php dd($advert)?>

<div class="container">
    <h1>{{ $advert->title }}</h1>
    <h2>{{ $advert->date }}</h2>
    <h4>Author: {{ $advert->author }}</h4>
    <h4>Postcode: {{ $advert->zip_code}}</h4>
    <img src="{{Storage::url($advert->image)}}" class="img-fluid">
    <p>Bescrijving: {{ $advert->advert_description }}</p>
</div>


@endsection ('body')
