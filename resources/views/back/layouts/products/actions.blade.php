@extends('back.layouts.back-master')
@section('css_before')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
@php
function ispisiDatum($datum)
{
    return  Carbon\Carbon::parse($datum)->format('d.m.Y h:i');
}
@endphp

<h4>
  <span class="naslov">Proizvodi na akciji</span>
  <span class="akcija">
  <a href="#" class="btn btn-sm btn-primary ml-30" data-toggle="modal" data-target="#novaAkcija">
        <i class="fas fa-plus-circle"></i> Nova akcija
  </a>
</span>
</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>ID</th>
      <th>Proizvod</th>
      <th>Akcija</th>
      <th>Trajanje</th>
      <th>Obriši akciju</th>
    </tr>
  </thead>
  <tbody>
@foreach($akcije as $akcija)
    <tr>
      <td>{{$akcija->id}}</td>
       <td>{{$akcija->product->name}}</td>
      <td><a href="{{route('action.show',$akcija->id)}}">{{$akcija->name}}</a></td>
      <td>{{ispisiDatum($akcija->date_start)}}<br>{{ispisiDatum($akcija->date_end)}}</td>
      <td><a href="akcija/brisi/{{ $akcija->id }}"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
@endforeach
  </tbody>
</table>

</div>
<!--modal za novu akciju-->
<div class="modal fade" id="novaAkcija" tabindex="-1" role="dialog" aria-hidden="true">
<!-- form start -->
<form enctype="multipart/form-data" action="{{ route('action.store') }}" method="POST">
{{ csrf_field() }}
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Nova akcija</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="row">
  <div class="col">
    <div class="form-group">
        <label for="name"><b>Naziv akcija:</b></label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label for="name">Odabrani proizvodi:</label>
        <select class="form-control" name="product" style="width: 100%;">
                    <option value=""></option>
                    @php
                    $proizvodi = auth()->user()->vendors->products;
                    @endphp
                    @foreach ($proizvodi as $proizvod)
                    <option value="{{$proizvod->id}}">{{$proizvod->name}}</option>
                    @endforeach
                                      </select>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Početak akcije</label>
            <input type="text" class="form-control date" id="start-date-picker" name="date_start">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Završetak akcije</label>
            <input type="text" class="form-control date" id="end-date-picker" name="date_end">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
            <label for="name"><b>Popust:</b></label>
            <input type="text" class="form-control" name="discount">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label for="name"><b>Posebna cijena:</b></label>
            <input type="text" class="form-control" name="price">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label for="name"><b>Kupon:</b></label>
            <input type="text" class="form-control" name="coupon">
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Spremi</button>
  </div>
</div>
</div>
</form>
</div>
@endsection
@section('js_after')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  $(() => {
    $('#start-date-picker').flatpickr({
      enableTime: true,
      dateFormat: "d.m.Y. H:i",
    })

    $('#end-date-picker').flatpickr({
      enableTime: true,
      dateFormat: "d.m.Y. H:i",
    })
  })
</script>
@endsection
