@php
$proizvodi = App\Models\OrderProduct::where('order_id',$narudzba->id)->get();
@endphp
<h5 class="text-black mb-0 mt-20">Naručeni proizvodi</h5>
<hr class="mb-30">
<div class="table-resposive-md">
  <table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Naziv</th>
      <th scope="col">Količina</th>
      <th scope="col">Cijena</th>
      <th scope="col">Popust</th>
      <th scope="col">Ukupno</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($proizvodi as $proizvod)
    <tr>
      <th scope="row">{{$proizvod->id}}</th>
      <td>{{$proizvod->name}}</td>
      <td>{{$proizvod->quantity}}</td>
      <td>{{$proizvod->price}}</td>
      <td>{{$proizvod->discount}}</td>
      <td>{{$proizvod->total}}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="5"><b>Ukupno:</b></td>
      <td><b>{{$narudzba->total}}</b></td>
    </tr>
  </tbody>
</table>
</div>
