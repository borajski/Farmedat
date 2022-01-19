<h5 class="text-black mb-0 mt-20">Opće informacije</h5>
<hr class="mb-30">
<div class="form-group">
    <label for="name">Status narudžbe:</label>
    @php
      $statusi = array("Novo","Čeka uplatu","U procesu","Poslano","Otkazano","Vraćeno");
      $status = $narudzba->order_status;
      $ime_statusa = $statusi[$status];
      unset($statusi[$status]);
    @endphp
    @if (auth()->user()->vendors)
    @if (auth()->user()->vendors->id == $narudzba->vendor_id)
    <select name="status" class="form-control">
        <option value="{{$status}}" selected>{{$ime_statusa}}</option>
         @foreach ($statusi as $key=>$value)
           <option value="{{$key}}">{{$value}}</option>
          @endforeach
    </select>
    @endif
    @else
    {{$ime_statusa}}
    @endif

</div>

    <p>
    <small>Način plaćanja:</small><br>
    <strong>{{$narudzba->payment_method}}</strong>
    </p>
    <p>
    <small>Način isporuke:</small><br>
    <strong>{{$narudzba->shipping_method}}</strong>
    </p>
<br>
