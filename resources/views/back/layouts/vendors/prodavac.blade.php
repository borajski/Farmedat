@extends('back.layouts.back-master')
@section('content')
@php
$i = 0;
$proizvodi = $prodavac->products;
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
<section>
@if (auth()->user()->details->role == "admin")
<h4>
<span class="akcija">  <a href="{{route('vendor.edit',$prodavac->id)}}" class="btn btn-success btn-sm" type="button">Uredi</a></span>
<br>
</h4>
@endif
    <div class="card card-primary">
    <div class="naslovna-slika" style="background-image: url('{{asset($prodavac->cover)}}');">
                                </div>
        
            <div class="card-body">
                <div class="row"> 
                <div class="col-md-6">
                  <h5>{{$prodavac->name}}</h5>
                  <p>{{$prodavac->user->name}}</p>
                  <img class="align-center img-responsive img-thumbnail" name="user_image" src="{{asset($prodavac->logo)}}" align="middle" width="250" alt="">
                </div>
                <div class="col-md-6">
                  @php
                   $onama = $prodavac->description;
                     echo $onama;
                  @endphp
                  <h4>{{$prodavac->oib}}<br>
                   {{$prodavac->address}}<br>{{$prodavac->zip}}&nbsp;{{$prodavac->city}}<br>
                    {{$prodavac->phone}}<br>
                    {{$prodavac->email}}<br>
                    {{$prodavac->www}}<br>
                </div>
                </div>
         </div>
</section>
    <!-- /.card -->
    <section>
    <div class="container">
        <div class="row">
          <h4>Proizvodi</h4>
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
    </div>
</section>
@endsection
