@extends ('layouts.app')

@section ('create')

userid: {{ Auth::user()->id}}
advertid: {{$advert->id}}
<?php dd($advert)?>
<br>
<div class="container">
    <form action="{{ route('bids.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="bid_amount">Bod</label>
        <div class="input-group-prepend">
          <div class="input-group-text">€</div>
          <input class="form-control" name="bid_amount" placeholder="Uw bod">
        </div>

    </div>
    <input type="hidden" name="advert_id" value="{{$advert->id}}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">

    <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>

@endsection ('create')
