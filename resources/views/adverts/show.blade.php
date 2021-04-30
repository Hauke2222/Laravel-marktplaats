@extends ('layouts.app')

@section ('body')

<div class="container">
    <h1>{{ $advert->title }}</h1><p>Datum: {{ $advert->date }}</p>
    <p>Author: {{ $advert->author }}</p>
    <p>Postcode: {{ $advert->zipCode->postcode}}</p>
    <p>Bescrijving: {{ $advert->advert_description }}</p>
    <img src="{{Storage::url($advert->image)}}" class="img-fluid">
    <br>
    <h1>Biedingen:</h1>
    <?php foreach($bidsFromDatabase as $bid) { ?>
        <p class="card-text"><?php echo $bid->created_at . ': €' . $bid->bid_amount; ?></p>

    <?php } ?>
    <a href="{{ route('bids.create', ['advert_id'=>$advert->id]) }}" class="card-link">Bied op product</a>

</div>


@endsection ('body')
