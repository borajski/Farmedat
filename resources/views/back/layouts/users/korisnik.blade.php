@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">O meni
            @if (auth()->user()->details->role == "admin")
            <span class="akcija">  <a href="{{route('user.edit',$korisnik->id)}}" class="btn btn-success btn-sm" type="button">Uredi</a></span>
            @endif
</h3>
          </div>
        <!-- /.card-header -->
        <!-- form start -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                  <img class="align-center img-responsive img-thumbnail" name="user_image" src="{{asset($korisnik->details->avatar)}}" align="middle" width="250" alt="">
                </div>
                <div class="col-md-6">
                  <h5>{{$korisnik->name}}</h5>
                  @php
                   $omeni = $korisnik->details->bio;
                     echo $omeni;
                  @endphp


                </div>
                </div>
         </div>
    <!-- /.card -->

@endsection
