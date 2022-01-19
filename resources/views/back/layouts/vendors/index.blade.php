@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
<div class="col-12">
  <h4>
  <span class="naziv"> Prodavači </span>
  </h4>
      <!-- ispis tablice -->
        <div class="table-responsive-sm">
        <table class="table table-hover bg-light shadow">
          <thead class="thead t-head" >
            <tr>
              <th>ID</th>
              <th>Logo</th>
              <th>Naziv</th>
              <th>Korisnik</th>
              <th>Obriši</th>
            </tr>
          </thead>
          <tbody>
        @foreach($prodavaci as $prodavac)
            <tr>
              <td>{{$prodavac->id}}</td>
              <td><a href="{{ route('vendor.show', $prodavac->id)}}"><img src="{{ asset($prodavac->logo)}}" height="30"></a></td>
              <td><a href="{{ route('vendor.show', $prodavac->id)}}"> {{$prodavac->name}}</a></td>
              <td>{{$prodavac->user->name}}</td>
              <td><a href="brisi/{{ $prodavac->id }}"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        @endforeach
          </tbody>
        </table>
      </div>
      </div>


@endsection
