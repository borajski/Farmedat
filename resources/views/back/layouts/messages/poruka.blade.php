@extends('back.layouts.back-master')
@section('content')
@php
$poruka1 = $poruke->where('parent_id',0)->first();
@endphp
<h4>{{$poruka1->subject}}
<span class="akcija">
<a href="{{route('user.show',$poruka1->sender->id)}}">
  <img src="{{asset($poruka1->sender->details->avatar)}}" style="height:30px; width:30px; border-radius:50%;">
</a>
<a href="{{route('user.show',$poruka1->recipient->id)}}">
  <img src="{{asset($poruka1->recipient->details->avatar)}}" style="height:30px;width:30px; border-radius:50%;">
</a>
</h4>
<br>
@foreach($poruke as $poruka)
@if ($poruka->sender->id == auth()->user()->id)
<div class="row p-4">
 <div class="col-sm-2">
   <img src="{{asset($poruka->sender->details->avatar)}}" style="height:50px; width:50px; border-radius:50%;">
   <p>{{$poruka->sender->name}}</p>
 </div>
 <div class="col-sm-10 bg-success p-3" style="opacity:0.6; border-radius:10px;">
  <span class="akcija">
    <a href="brisi/{{ $poruka->id }}"> <i class="fas fa-times-circle"></i></a></span>
   <small>{{date_format(date_create($poruka->created_at), 'h:i d.m.Y.')}}</small><br>
     {{$poruka->message_content}}
 </div>
</div>
@else
<div class="row p-4">
 <div class="col-sm-10  bg-info p-3"  style="opacity:0.6; border-radius:10px;">
   <span class="akcija"><a href="" data-toggle="modal" data-target="#odgovor">
     <i class="fas fa-reply"></i></a></span>
   <small>{{date_format(date_create($poruka->created_at), 'h:i d.m.Y.')}}</small><br>
   {{$poruka->message_content}}
 </div>
 <div class="col-sm-2">
   <span class="akcija"><img src="{{asset($poruka->sender->details->avatar)}}" style="height:50px; width:50px; border-radius:50%;">
   <p>{{$poruka->sender->name}}</p></span>
 </div>
</div>
@endif
@endforeach
<!-- Modal za slanje odgovora-->
<div class="modal fade" id="odgovor" tabindex="-1" role="dialog" aria-hidden="true">
<!-- form start -->
<form enctype="multipart/form-data" action="{{ route('message.store') }}" method="POST">
{{ csrf_field() }}
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Odgovor</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="row">
  <div class="col-md-12">
    <div class="form-group">
        <input type="hidden" class="form-control" name="recipient" value="{{$poruka1->sender->id}}">
        <input type="hidden" class="form-control" name="parent" value="{{$poruka1->id}}">
          <input type="hidden" class="form-control" name="subject" value="{{$poruka1->subject}}">
    </div>
    <div class="form-group">
          <label for="description"><b>Poruka:</b></label>
          <textarea class="form-control" rows="10" name="message_content" style="width: 100%"></textarea>
      </div>
  </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Pošalji</button>
  </div>
</div>
</div>
</form>
</div>
@endsection
