@extends('back.layouts.back-master')
@section('content')
@php
function ime_kategorije($oznaka,$id)
{
  if ($oznaka == "K")
  {
    $kategorija = App\Models\Category::find($id);
    return $kategorija->name;
  }
  else
  {
    $podkategorija = App\Models\Subcategory::find($id);
    return $podkategorija->name;
  }

}
@endphp
<h4>Proizvodi
  <small>
      <span class="akcija">
          <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary ml-30" data-toggle="tooltip">
                <i class="fas fa-plus-circle"></i> Novi proizvod
          </a>
      </span>
  </small>
</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>ID</th>
      <th>Naziv</th>
      <th>Kategorija</th>
      <th>Podkategorija</th>
      <th>Obriši</th>
    </tr>
  </thead>
  <tbody>
@foreach($proizvodi as $proizvod)
    <tr>
      <td>{{$proizvod->id}}</td>
       <td><a href="{{ route('product.show', $proizvod->id)}}"> {{$proizvod->name}}</a></td>
      <td>{{ime_kategorije("K",$proizvod->category)}}</td>
      <td>{{ime_kategorije("P",$proizvod->subcategory)}}</td>
      <td><a href="brisi/{{ $proizvod->id }}"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@endsection
