@extends('back.layouts.back-master')
@section('content')
<h4>Naručeno</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>Br.nar.</th>
      <th>Prodavač</th>
      <th>Datum</th>
      <th>Status</th>
      <th>Plaćanje</th>
      <th>Ukupno</th>
    </tr>
  </thead>
  <tbody>
@foreach($naruceno as $narudzba)
    <tr>
      <td><a href="{{ route('order.show', $narudzba->id)}}">{{$narudzba->id}}</a></td>       
      <td><a href="{{ route('vendor.show', $narudzba->vendor->id)}}">{{$narudzba->vendor->name}}</a></td>
      <td>{{ date_format(date_create($narudzba->created_at), 'd.m.Y.') }}</td>
      <td>
      @php
      $statusi = array("Novo","Čeka uplatu","U procesu","Poslano","Otkazano","Vraćeno");
      $status = $narudzba->order_status;
      $ime_statusa = $statusi[$status];
      unset($statusi[$status]);
      @endphp  
      {{$ime_statusa}}</td>      
      <td>{{$narudzba->payment_method}}</td>
      <td>{{$narudzba->total}}</td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@endsection
