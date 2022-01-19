@extends('back.layouts.back-master')
@section('content')


<div class="container mt-3">
  <form enctype="multipart/form-data" action="{{route('order.update', $narudzba->id)}}"  method="POST">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <h4>
    <span class="naslov">Pregled narudžbe</span>
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
      <a class="nav-link" data-toggle="tab" href="#foto"><i class="fas fa-cogs"></i> Proizvodi</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content bg-light">
    <div id="home" class="container tab-pane active"><br>
      @include('back.layouts.orders.partials.general')
    </div>
    <div id="detalji" class="container tab-pane fade"><br>
      @include('back.layouts.orders.partials.details')
    </div>
    <div id="foto" class="container tab-pane fade"><br>
  @include('back.layouts.orders.partials.products')  </div>
  </div>
</form>
</div>
@endsection
