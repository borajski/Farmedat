@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
<div class="col-12">
  <h4>
  <span class="naziv"> Korisnici </span>
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
              <th>Obriši</th>
            </tr>
          </thead>
          <tbody>
        @foreach($korisnici as $korisnik)
         @if ($korisnik->details != NULL)
            <tr>
              <td>{{$korisnik->id}}</td>
              <td><a href="{{ route('user.show', $korisnik->id)}}"><img src="{{ asset($korisnik->details->avatar)}}" height="30"></a></td>
              <td><a href="{{ route('user.show', $korisnik->id)}}"> {{$korisnik->name}}</a></td>
              <td>{{$korisnik->details->role}}</td>
              <td><a href="brisi_korisnika/{{ $korisnik->id }}"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            @else
            <tr>
              <td>{{$korisnik->id}}</td>
              <td><a href="{{ route('user.show', $korisnik->id)}}"><img src="" height="30"></a></td>
              <td><a href="{{ route('user.show', $korisnik->id)}}"> {{$korisnik->name}}</a></td>
              <td>NULL</td>
              <td><a href="brisi_korisnika/{{ $korisnik->id }}"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
          @endif
        @endforeach
          </tbody>
        </table>
      </div>
      </div>


@endsection
