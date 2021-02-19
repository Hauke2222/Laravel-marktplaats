@extends ('layouts.app')

@section ('body')
<br>
<div class="container">
    <form action="{{ route('adverts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Advertentie Naam</label>
        <input class="form-control" id="exampleFormControlInput1" placeholder="Advertentie naam">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Kies een categorie</label>
        <select multiple class="form-control" id="exampleFormControlSelect2">
        <option>Meubels</option>
        <option>Sport</option>
        <option>Gereedschap</option>
        <option>Boeken</option>
        <option>Technologie</option>
        <option>Cultuur</option>
        <option>Overig</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Beschrijving</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Bescrijf hier uw product"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Foto</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>

@endsection ('body')
