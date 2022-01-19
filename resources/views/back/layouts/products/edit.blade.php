@extends('back.layouts.back-master')
@section('content')
@php
if (isset($proizvod))
{
  $ime = $proizvod->name;
  $vendor = $proizvod->vendor_id;
  $opis= $proizvod->description;
  $sku=  $proizvod->sku;
  $kategorija_ime= App\Models\Category::find($proizvod->category)->name;
  $kategorija_id= $proizvod->category;
  $podkategorija_ime= App\Models\Subcategory::find($proizvod->subcategory)->name;
  $podkategorija_id= $proizvod->subcategory;
  $cijena= $proizvod->price;
  $jedinica= $proizvod->measure_unit;
  $kolicina= $proizvod->quantity;
  $dostava= $proizvod->delivery_type;
  $cijena_dostave= $proizvod->delivery_price;
  $dostava_in= $proizvod->delivery_include;
  $minimum= $proizvod->min_order;
  $online= $proizvod->live;
  $slika= $proizvod->image;
}
else
{
  $ime = "";
  $vendor = auth()->user()->vendors->id;
  $opis= "";
  $sku=  "";
  $kategorija_ime= "";
  $kategorija_id= "";
  $podkategorija_ime= "";
  $podkategorija_id= "";
  $cijena= "";
  $jedinica= "";
  $kolicina= "";
  $dostava= "";
  $cijena_dostave= "";
  $dostava_in= "";
  $minimum= "";
  $online= "ne";
  $slika= "";
}
@endphp

<div class="container mt-3">
  @if (isset($proizvod))
  <form enctype="multipart/form-data" action="{{ route('product.update', $proizvod->id) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  @else
  <form enctype="multipart/form-data" action="{{route('product.store')}}"  method="POST">
  {{ csrf_field() }}
  @endif
  <h4>
    @if (isset($proizvod))
    <span class="naslov">Pregled proizvoda</span>
    @else
    <span class="naslov">Novi proizvod</span>
    @endif
    <span class="akcija">  <button type="submit" class="btn btn-primary">Spremi</button></span>
  </h4>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs t-head">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-home"></i> Opće informacije</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#detalji"><i class="fas fa-book-open"></i> Detalji</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#foto"><i class="fas fa-images"></i> Fotografije</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content bg-light">
    <div id="home" class="container tab-pane active"><br>
      @include('back.layouts.products.partials.general')
    </div>
    <div id="detalji" class="container tab-pane fade"><br>
      @include('back.layouts.products.partials.details')
    </div>
    <div id="foto" class="container tab-pane fade"><br>
  @include('back.layouts.products.partials.photos')  </div>
  </div>
</form>
</div>
@endsection
