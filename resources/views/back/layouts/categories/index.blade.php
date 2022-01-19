@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
<div class="col-12">
  <h4>
  <span class="naziv"> Grupe kategorija </span>
  @if (auth()->user()->details->role == 'admin')
  <span class="akcija">
  <a href="#" type="button" data-toggle="modal" data-target="#noviUnos">
  <i class="fas fa-plus-circle"></i></a>
  </span>
  @endif
  </h4>
  @if (auth()->user()->details->role == 'admin')
        <!-- Modal za unos nove grupe-->
    <div class="modal fade" id="noviUnos" tabindex="-1" role="dialog" aria-hidden="true">
      <!-- form start -->
      <form enctype="multipart/form-data" action="{{ route('group.store') }}" method="POST">
        {{ csrf_field() }}
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Dodaj novu grupu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
          <div class="col-md-6">
            <div class="form-group align-center">
              <label for="image">Odaberi sliku grupe</label>
              <br>
              <img class="align-center img-responsive img-thumbnail" id="previewImg"name="slika" src="https://via.placeholder.com/250" align="middle" width="250" alt="">
              <input type="file" class="form-control-file"name="image" onchange="previewFile(this);">
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="name"><b>Naziv grupe:</b></label>
                <input type="text" class="form-control" name="name">
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
      <!-- ispis tablice -->
        <div class="table-responsive-sm">
        <table class="table table-hover bg-light shadow">
          <thead class="thead t-head" >
            <tr>
              <th>ID</th>
              <th>Slika</th>
              <th>Naziv</th>
              <th>Kategorije</th>
              @if (auth()->user()->details->role == 'admin')
              <th>Obriši</th>
              @endif
            </tr>
          </thead>
          <tbody>
        @foreach($grupe as $idea)
            <tr>
              <td>{{$idea->id}}</td>
              <td><a href="{{ route('group.show', $idea->id)}}"><img src="{{ asset($idea->image)}}" height="30"></a></td>
              <td><a href="{{ route('group.show', $idea->id)}}"> {{$idea->name}}</a></td>
              <td>{{$idea->categories->count()}}</td>
              @if (auth()->user()->details->role == 'admin')
              <td><a href="brisi/{{ $idea->id }}"><i class="fas fa-trash-alt"></i></a></td>
              @endif
            </tr>
        @endforeach
          </tbody>
        </table>
      </div>
      </div>
@endsection
