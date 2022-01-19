@extends('back.layouts.back-master')
@section('content')
<div class="col-12">
  <h4>
  <span class="naziv"> Pratim </span>
  </h4>
      <!-- ispis tablice -->
        <div class="table-responsive-sm">
        <table class="table table-hover bg-light shadow">
          <thead class="thead t-head" >
            <tr>
              <th>ID</th>
              <th>Slika</th>
              <th>Korisnik</th>
              <th>Prodavač</th>
            </tr>
          </thead>
          <tbody>
        @foreach($followers as $pratnja)
        <tr>
              <td>{{$pratnja->vendor->user->id}}</td>
              <td><a href="{{ route('user.show', $pratnja->vendor->user->id)}}"><img src="{{ asset($pratnja->vendor->user->details->avatar)}}" height="30"></a></td>
              <td><a href="{{ route('user.show', $pratnja->vendor->user->id)}}"> {{$pratnja->vendor->user->name}}</a></td>
              <td><a href="{{ route('vendor.show', $pratnja->vendor->id)}}">{{$pratnja->vendor->name}}</td>
              
            </tr>
      
        @endforeach
          </tbody>
        </table>
      </div>
      </div>


@endsection
