@extends ('layouts.app')

@section ('body')
<br><br>
<div class="container">
    <ul id="cardList">
    <br>
    <?php foreach($advertsFromDatabase as $advert) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $advert->title; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $advert->author . ', ' . $advert->date ; ?></h6>
                <h6 class="card-text">Categorie:<?php foreach( $advert->categories as $category){echo ' ' . $category->name . ', ';} ?></h6>
                <p class="card-text"><?php echo $advert->zip_code; ?></p>
                <a href="#" class="card-link">Bekijk product</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    <br>
    <?php } ?>
    </ul>
</div>
@endsection ('body')
