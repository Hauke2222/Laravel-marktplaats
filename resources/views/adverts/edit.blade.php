@extends ('layouts.app')

@section ('edit')


<br>
<div class="container">
    <form action="{{ route('adverts.update', $advert->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Advertentie Naam</label>
        <input class="form-control" name="title" value="{{ $advert->title }}">
    </div>
    <div class="form-group">
        <label for="date">Datum</label>
        <input class="form-control" name="date" type="date" value="{{ $advert->date }}">
    </div>
    <div class="form-group">
        <label for="zip_code">Naam</label>
        <input class="form-control" name="author" value="{{ $advert->author }}">
    </div>
    <div class="form-group">
        <label for="zip_code">Postcode</label>
        <input class="form-control" name="zip_code" value="{{ $advert->zip_code }}">
    </div>
    <div class="form-group">
    <select name="categories[]" class="form-control" id="categories" multiple>
            @foreach($advertCategoriesFromDatabase as $category)
            @php ($advert->categories->contains($category->id)) ? $selected = 'selected' : $selected = '' @endphp
            <option value="{{ $category->id }}" {{$selected}}>{{ $category->name }}</option>
            }
            @endforeach
        </select>
        <?php foreach( $selectedCategories as $selectedCategory){echo $selectedCategory->name . ', ';} ?>
    </div>
    <div class="form-group">
        <label for="advert_description">Beschrijving</label>
        <textarea class="form-control" name="advert_description" rows="3" value="{{ $advert->advert_description }}"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Foto</label>
        <input type="file" class="form-control-file" name="image">
    </div>
    <div class="form-group">
        <label for="premium_advert">Premium:</label>
        <input type="checkbox" id="premium_advert" name="premium_advert"
        value="{{ $advert->premium_advert }}"
        @if ($advert->premium_advert) checked @endif>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>
@endsection ('edit')
