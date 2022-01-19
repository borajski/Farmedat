@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
@php
$kategorija = $podkategorija->category;
$grupa = $kategorija->group;
@endphp
<h4><a href="/group">Grupe</a>\<a href="{{ route('group.show', $grupa->id)}}">{{$grupa->name}}</a>\<a href="{{route('category.show', $kategorija->id)}}">{{$kategorija->name}}</a>\{{$podkategorija->name}}</h4>
<div class="card  shadow border-0">
   <div class="card-header  t-head">
      <h3 class="card-title">{{$podkategorija->name}}</h3>
   </div>
  <div class="card-body bg-light">
    <div class="row">
      <div class="col-md-6">
        <img class="align-center img-responsive img-thumbnail" name="slika" src="{{ asset($podkategorija->image)}}" align="middle" width="250" alt="">
      </div>
      <div class="col-md-6">
        <p>{{$podkategorija->description}}</p>
        <h5>Slug: </h5>{{$podkategorija->slug}}
        <h5>Redni broj linka: </h5>{{$podkategorija->redni}}
      </div>
    </div>
    <div class="row">
      <div class="col">
       @if ($podkategorija->live == "ne")
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
 @if (auth()->user()->details->role == 'admin')
<!-- /.card-body -->
<div class="card-footer bg-light">
  <a href="#" class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#urediPodkategoriju">Uredi</a>
</div>
@endif
</div>
<br>
@if (auth()->user()->details->role == 'admin')
<!-- Modal za uređivanje kategorije-->
<div class="modal fade" id="urediPodkategoriju" tabindex="-1" role="dialog" aria-hidden="true">
<!-- form start -->
<form enctype="multipart/form-data" action="{{ route('subcategory.update',$podkategorija->id) }}" method="POST">
{{ csrf_field() }}
{{ method_field('patch') }}
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Uredi {{$podkategorija->name}}</h5>
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
      <img class="align-center img-responsive img-thumbnail" id="previewImg"name="slika" src="{{asset($podkategorija->image)}}" align="middle" width="250" alt="">
      <input type="file" class="form-control-file"name="image" onchange="previewFile(this);">
  </div>
  <div class="form-group">
        <label for="redni"><b>Redni broj linka:</b></label>
        <input type="text" class="form-control" name="redni" value="{{$podkategorija->redni}}">
    </div>
  <div class="naslov">
    <br>
 <label for="javnost">On/off line</label>
<br>
<label class="switch">
@if ($podkategorija->live == "ne")
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
        <label for="name"><b>Naziv podkategorije:</b></label>
        <input type="text" class="form-control" name="name" value="{{$podkategorija->name}}">
    </div>
    <div class="form-group">
        <label for="slug"><b>Slug:</b></label>
        <input type="text" class="form-control" name="slug" value="{{$podkategorija->slug}}">
    </div> 
      <div class="form-group">
          <label for="description"><b>Opis:</b></label>
          <textarea class="form-control" rows="10" name="description" style="width: 100%">{{$podkategorija->description}}</textarea>
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
@endif


@endsection
