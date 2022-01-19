@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
<h4><a href="/group">Grupe</a>\<a href="{{ route('group.show', $kategorija->group->id)}}">{{$kategorija->group->name}}</a>\{{$kategorija->name}}</h4>
<div class="card  shadow border-0">
   <div class="card-header  t-head">
      <h3 class="card-title">{{$kategorija->name}}</h3>
   </div>
  <div class="card-body bg-light">
    <div class="row">
      <div class="col-md-6">
        <img class="align-center img-responsive img-thumbnail" name="slika" src="{{ asset($kategorija->image)}}" align="middle" width="250" alt="">
      </div>
      <div class="col-md-6">
        <p>{{$kategorija->description}}</p>
        <h5>Slug: </h5>{{$kategorija->slug}}
        <h5>Redni broj linka: </h5>{{$kategorija->redni}}
      </div>
    </div>
    <div class="row">
      <div class="col">
       @if ($kategorija->live == "ne")
        <div class="akcija">
         <h6>Off line</h6>
        </div>
        @else
        <div class="akcija">
         <h6>On line</h6>
        </div>
      @endif
      <br>
    </div>
   </div>
 </div>
<!-- /.card-body -->
@if (auth()->user()->details->role == 'admin')
<div class="card-footer bg-light">
  <a href="#" class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#urediKategoriju">Uredi</a>
  <a href="#" class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#novaPodkategorija">Nova podkategorija</a>
</div>
@endif
</div>
<br>
<!-- ispis tablice -->
@php
$podkategorije = $kategorija->subcategories;
@endphp
<h5>Podkategorije</h>
  <div class="table-responsive-sm">
  <table class="table table-hover bg-light shadow">
    <thead class="thead t-head" >
      <tr>
        <th>ID</th>
        <th>Slika</th>
        <th>Naziv</th>
        <th>Proizvodi</th>
        @if (auth()->user()->details->role == 'admin')
        <th>Obriši</th>
        @endif
      </tr>
    </thead>
    <tbody>
  @foreach($podkategorije as $podkat)
      <tr>
        <td>{{$podkat->id}}</td>
        <td><a href="{{ route('subcategory.show', $podkat->id)}}"><img src="{{ asset($podkat->image)}}" height="30"></a></td>
        <td><a href="{{ route('subcategory.show', $podkat->id)}}"> {{$podkat->name}}</a></td>
        <td>broj</td>
        @if (auth()->user()->details->role == 'admin')
        <td><a href="brisi/{{ $podkat->id }}"><i class="fas fa-trash-alt"></i></a></td>
        @endif
      </tr>
  @endforeach
    </tbody>
  </table>
@if (auth()->user()->details->role == 'admin')
<!-- Modal za uređivanje kategorije-->
<div class="modal fade" id="urediKategoriju" tabindex="-1" role="dialog" aria-hidden="true">
<!-- form start -->
<form enctype="multipart/form-data" action="{{ route('category.update',$kategorija->id) }}" method="POST">
{{ csrf_field() }}
{{ method_field('patch') }}
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Uredi {{$kategorija->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="row">
  <div class="col-md-6">
    <div class="form-group align-center">
      <label for="image">Slika grupe</label>
      <br>
      <img class="align-center img-responsive img-thumbnail" id="previewImg"name="slika" src="{{asset($kategorija->image)}}" align="middle" width="250" alt="">
      <input type="file" class="form-control-file"name="image" onchange="previewFile(this);">
  </div>
  <div class="form-group">
        <label for="redni"><b>Redni broj linka:</b></label>
        <input type="text" class="form-control" name="redni" value="{{$kategorija->redni}}">
    </div>
  <div class="naslov">
    <br>
 <label for="javnost">On/off line</label>
<br>
<label class="switch">
@if ($kategorija->live == "ne")
<input type="checkbox" name="live">
@else
<input type="checkbox" name="live" checked>
@endif
<span class="slider"></span>
</label>

        </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label for="name"><b>Naziv kategorije:</b></label>
        <input type="text" class="form-control" name="name" value="{{$kategorija->name}}">
    </div>
    <div class="form-group">
        <label for="slug"><b>Slug:</b></label>
        <input type="text" class="form-control" name="slug" value="{{$kategorija->slug}}">
    </div> 
      <div class="form-group">
          <label for="description"><b>Opis:</b></label>
          <textarea class="form-control" rows="10" name="description" style="width: 100%">{{$kategorija->description}}</textarea>
      </div>
  </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Uredi</button>
  </div>
</div>
</div>
</form>
</div>
<!--modal za novu podkategoriju-->
<div class="modal fade" id="novaPodkategorija" tabindex="-1" role="dialog" aria-hidden="true">
<!-- form start -->
<form enctype="multipart/form-data" action="{{ route('subcategory.store') }}" method="POST">
{{ csrf_field() }}
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Nova podkategorija</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="row">
  <div class="col-md-6">
    <div class="form-group align-center">
      <label for="image">Slika podkategorije</label>
      <br>
      <img class="align-center img-responsive img-thumbnail" id="previewImg"name="slika" src="https://via.placeholder.com/250" align="middle" width="250" alt="">
      <input type="file" class="form-control-file"name="image" onchange="previewFile(this);">
  </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label for="name"><b>Naziv podkategorije:</b></label>
        <input type="text" class="form-control" name="name">
        <input type="hidden" class="form-control" name="category_id" value="{{$kategorija->id}}">
    </div>
      <div class="form-group">
          <label for="description"><b>Opis:</b></label>
          <textarea class="form-control" rows="10" name="description" style="width: 100%"></textarea>
      </div>
  </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Dodaj</button>
  </div>
</div>
</div>
</form>
</div>
@endif
@endsection
