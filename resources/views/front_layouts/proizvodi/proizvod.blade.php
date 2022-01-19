@extends('front_layouts.front-master')
@section('content')
<section>
@php
$i = 0;
$slika = 0;
function ime_kategorije($oznaka,$id)
{
  if ($oznaka == "K")
  {
    $kategorija = App\Models\Category::find($id);
    return $kategorija->name;
  }
  else
  {
    $podkategorija = App\Models\Subcategory::find($id);
    return $podkategorija->name;
  }

}
@endphp
<div class="container">
        <div class="row mt-5">
            <div class="col-md-6 text-center">
                <img class="img-fluid  img-thumbnail prod-img" id="glavna_slika" src="{{asset($proizvod->image)}}">
                <!-- <div class="prod-img-wrapper" style="background-image: url('{{asset($proizvod->image)}}');">
                </div> -->
                @if (isset($slike))
                @foreach ($slike as $foto) 
                  @php
                    $i++;
                    $slika++;
                  @endphp
                  @if ($i == 1)
                    <div class="row red-slika">
                  @endif
                <div class="col-md-3">
                <img class="img-responsive img-thumbnail" id="slika{{$slika}}" src="{{asset($foto->image)}}" style="height:6rem; width: 6rem;" onClick="changeImage(this.id)">
                </div>
                  @if ($i == 4)
                    </div>
                     @php
                    $i = 0;
                    @endphp
                  @endif
                @endforeach
                @if ($i < 4)
                </div>
                @endif
                @endif
            </div>
            <div class="col-md-6">
            <div class="prod-text-wrapper">
                <h2>{{$proizvod->name}}</h2>
                <h4>farmed@ {{$proizvod->vendor->name}}</h4>
                <p><strong>Kategorija:</strong> {{ime_kategorije("K",$proizvod->category)}} <span class="float-right"><strong>Podkategorija:</strong> {{ime_kategorije("S",$proizvod->subcategory)}}</span></p>
                <hr>
                 @php
                 echo $proizvod->description;
                 @endphp
<hr>
              <h5>Dostupnost: {{$proizvod->quantity}} {{$proizvod->measure_unit}}</h5>
              <h5>Dostava: {{$proizvod->delivery_type}}</h5>
              <h5>Cijena dostave: {{$proizvod->delivery_price}}</h5>
              <h5>Dostava uključena u cijenu: {{$proizvod->delivery_include}}</h5>
              <h5>Minimalna narudžba: {{$proizvod->min_order}}</h5>
              <hr><h5>Naruči: </h5>
              <div class="qty-wrapper text-center mb-2">
               
              <input type="button" value="-" data-for="qty">
  <input type="text" id="qty" value="1" min="0">
  <input type="button" value="+" data-for="qty"> 
  </div>
  <p class="btn-holder"><a href="#" id="link" onmouseover="kartica({{$proizvod->id}})" class="btn btn-warning btn-block text-center gumb" role="button">Add to cart</a> </p>
    </div>
</div>
            </div>
</div>
</div>
</section>
@endsection
@section('js_after')
<script type="text/javascript">
    document.addEventListener("click", handle);

function handle(evt) {
   if (evt.target.type === "button") {
    return handleBtn(evt.target);
  }
}

function handleBtn(btn) {
  const elem = document.querySelector(`#${btn.dataset.for}`);
  const nwValue = +elem.value + (btn.value === "-" ? -1 : 1);
  elem.value = nwValue >= +elem.min ? nwValue : elem.min;
}
function changeImage (id_change)
{
  var manja_slika;
  var glavna_slika;
  glavna_slika = document.getElementById("glavna_slika").src;
  manja_slika = document.getElementById(id_change).src;
  document.getElementById("glavna_slika").src = manja_slika;
  document.getElementById(id_change).src= glavna_slika;
}
function kartica (id) {
  
    document.getElementById("link").href = "/add-to-cart/" + id + "/" + document.getElementById("qty").value;
}
        </script>
@endsection
