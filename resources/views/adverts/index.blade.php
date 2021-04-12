@extends ('layouts.app')

@section ('body')
<br>
<div class="container">

    <div class="input-group">
    <form class="form-row mx-auto" action="/search" method="GET" role="search">
    @csrf
    <div class="col">
        <input type="text" name="searchQuery" placeholder="Zoek term" class="form-control">
    </div>
    <div class="col">
        <input type="text" name="zip" placeholder="Uw Postcode" class="form-control">
    </div>

    <div class="col">
        <div class="input-group-append">
            <select name="selectedDistance" class="custom-select">
                <option value="5">5km</a>
                <option value="10">10km</a>
                <option value="15">15km</a>
                <option value="20">20km</a>
                <option value="25">25km</a>
                <option value="50">50km</a>
                <option value="50">100km</a>
                <option value="50">250km</a>
            </select>
        </div>
    </div>
    <button class="btn btn-secondary" type="submit">Zoek</button>
    </form>

    </div>

    <br>

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
    <p>{{ $advertsFromDatabase->links() }}</p>
</div>
@endsection ('body')
