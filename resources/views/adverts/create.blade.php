@extends ('layouts.app')

@section ('create')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<br>
<div class="container">
    <form action="{{ route('adverts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Advertentie Naam</label>
        <input class="form-control" name="title" placeholder="Advertentie naam">
    </div>
    <div class="form-group">
        <label for="date">Datum</label>
        <input class="form-control" name="date" type="date" placeholder="0000XX">
    </div>
    <div class="form-group">
        <label for="name">Naam</label>
        <input class="form-control" name="author" placeholder="Naam">
    </div>
    <div class="form-group">
        <label for="zip_code">Postcode</label>
        <input class="form-control" name="zip_code" placeholder="0000XX">
    </div>
    <div class="form-group">
        <label for="categories[]">Kies een categorie</label>
        <select multiple class="form-control" name="categories[]">
        <?php foreach($advertCategoriesFromDatabase as $category) { ?>
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="advert_description">Beschrijving</label>
        <textarea class="form-control" name="advert_description" rows="3" placeholder="Bescrijf hier uw product"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Foto</label>
        <input type="file" class="form-control-file" name="image">
    </div>
    <div class="form-group">
        <label for="premium_advert">Premium</label>
        <input type="checkbox" name="premium_advert">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>

@endsection ('create')
