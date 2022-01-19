@extends('back.layouts.back-master')
@section('content')
<div class="col-12">
  <h4>
  <span class="naziv"> Prate me </span>
  </h4>
      <!-- ispis tablice -->
        <div class="table-responsive-sm">
        <table class="table table-hover bg-light shadow">
          <thead class="thead t-head" >
            <tr>
              <th>ID</th>
              <th>Slika</th>
              <th>Naziv</th>
              <th>Uloga</th>
            </tr>
          </thead>
          <tbody>
        @foreach($followers as $pratnja)
        <tr>
              <td>{{$pratnja->user->id}}</td>
              <td><a href="{{ route('user.show', $pratnja->user->id)}}"><img src="{{ asset($pratnja->user->details->avatar)}}" height="30"></a></td>
              <td><a href="{{ route('user.show', $pratnja->user->id)}}"> {{$pratnja->user->name}}</a></td>
              <td>{{$pratnja->f_status}}</td>
              
            </tr>
      
        @endforeach
          </tbody>
        </table>
      </div>
      </div>


@endsection
