@extends ('layouts.app')

@section ('body')
<br><br>
<div class="container">

    <div class="input-group">
    <form class="" action="/search" method="GET" role="search">
    @csrf
    <input type="text" placeholder="Zoek" class="form-control">
    <input type="text" placeholder="Uw Postcode" class="form-control">

    <div class="input-group-append">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Afstand</button>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">5km</a>
        <a class="dropdown-item" href="#">10km</a>
        <a class="dropdown-item" href="#">15km</a>
        <a class="dropdown-item" href="#">20km</a>
        <a class="dropdown-item" href="#">25km</a>
        <a class="dropdown-item" href="#">50km</a>
        </div>
    </div>
    <button class="btn btn-secondary" type="submit">Zoek</button>
    </form>

    </div>

    <br><br>

    <ul id="cardList">
    <br>
    <div class="row row-cols-1 row-cols-md-2">
    <?php foreach($advertsFromDatabase as $advert) { ?>
    <div class="col mb-4">
    <div class="card" style="width: 25rem;">
      <img src="{{Storage::url($advert->image)}}" class="card-img-top" alt="...">
      <div class="card-body">
      <h5 class="card-title"><?php echo $advert->title; ?></h5>
      <h6 class="card-subtitle mb-2 text-muted"><?php echo $advert->author . ', ' . $advert->date ; ?></h6>
      <h6 class="card-text">Categorie:<?php foreach( $advert->categories as $category){echo ' ' . $category->name . ', ';} ?></h6>
        <p class="card-text"><?php echo $advert->zip_code; ?></p>
        <a href="{{ route('adverts.show', $advert->id) }}" class="card-link">Bekijk product</a>
        <a href="{{ route('bids.create', ['advert_id'=>$advert->id]) }}" class="card-link">Bied op product</a>
      </div>
    </div>
  </div>
  <?php } ?>
    </div>
    </ul>
</div>
@endsection ('body')
