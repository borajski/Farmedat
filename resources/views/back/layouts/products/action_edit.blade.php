@extends('back.layouts.back-master')
@section('content')
@php
function ispisiDatum($datum)
{
    return  Carbon\Carbon::parse($datum)->format('d.m.Y h:i');
}
@endphp
<div class="card  shadow border-0">
   <div class="card-header  t-head">
      <h3 class="card-title">{{$akcija->name}}</h3>
   </div>
   <form enctype="multipart/form-data" action="{{route('action.update',$akcija->id)}}" method="POST">
   {{ csrf_field() }}
     {{ method_field('patch') }}
  <div class="card-body bg-light">
    <div class="row">
      <div class="col">
        <div class="form-group">
            <label for="name"><b>Naziv akcije:</b></label>
            <input type="text" class="form-control" name="name" value="{{$akcija->name}}">
        </div>
        <div class="form-group">
            <label for="name">Odabrani proizvod:</label>
            <select class="form-control" name="product" style="width: 100%;">
                        <option value="{{$akcija->product_id}}" selected>{{$akcija->product->name}}</option>
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
                <input type="text" class="form-control date" name="date_start" value="{{ispisiDatum($akcija->date_start)}}">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Završetak akcije</label>
                <input type="text" class="form-control date"  name="date_end" value="{{ispisiDatum($akcija->date_end)}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
                <label for="name"><b>Popust:</b></label>
                <input type="text" class="form-control" name="discount" value="{{$akcija->discount}}">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
                <label for="name"><b>Posebna cijena:</b></label>
                <input type="text" class="form-control" name="price" value="{{$akcija->price}}">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
                <label for="name"><b>Kupon:</b></label>
                <input type="text" class="form-control" name="coupon" value="{{$akcija->coupon}}">
            </div>
          </div>
        </div>
      </div>
    </div>

 </div>
<!-- /.card-body -->
<div class="card-footer bg-light">
<button type="submit" class="btn btn-primary">Spremi</button>

</div>
</div>
@endsection
