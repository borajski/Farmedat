@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
$kategorije = $grupa->categories;
@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-center mt-3 mb-0">{{$grupa->name}}</h2>
                <p class="text-muted h3 text-center mt-3 mb-4">{{$grupa->description}}</p>
                <div class="naslovna-slika" style="background-image:url('{{asset($grupa->image)}}');">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-4">


<div class="container pt-4">
    <div class="row">
        <div class="col-md-3">
<div class="sidenav">
@foreach ($kategorije as $kategorija)
    @if ($kategorija->live == 'da')
     @if ($kategorija->subcategories->count() > 0)
        <button class="dropdown-btn">{{$kategorija->name}}</button>
        <div class="dropdown-container">
            @foreach ($kategorija->subcategories as $podkategorija)
                @if ($podkategorija->live == 'da')
                    <a href="kategorija/podkategorija/{{$podkategorija->id}}">{{$podkategorija->name}}</a>
                @endif
            @endforeach
        </div>
     @else
     <a href="kategorija/{{$kategorija->id}}">{{$kategorija->name}}</a>
     @endif
     @endif
@endforeach
</div>

<!-- stari izgled menija 


            <ul class="list-unstyled components">
            @foreach ($kategorije as $kategorija)
            @if ($kategorija->live == 'da')
            <li>
            @if ($kategorija->subcategories->count() > 0)
            <a class="podmenu-link dropdown-toggle" href="#{{$kategorija->name}}" data-toggle="collapse" aria-expanded="false">
            @else
            <a class="podmenu-link" href="">
            @endif
            <strong>{{$kategorija->name}}</strong></a></li>
            @if ($kategorija->subcategories->count() > 0)
                    <ul class="collapse list-unstyled" id="{{$kategorija->name}}">
                        @foreach ($kategorija->subcategories as $podkategorija)
                        @if ($podkategorija->live == 'da')
                        <li class="nav-item">
                            <a class="nav-link podmenu-link" href="">{{$podkategorija->name}}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @endif   
            @endif
            @endforeach
            </ul> -->


                </div>
        <div class="col-md-9">
        <div class="naslov mb-4">
                <h3 class="text-center">Kategorije</h3>
</div>
@foreach ($kategorije as $kategorija)
                @php
                $i++;
                @endphp
                @if ($i == 1)
                <div class="row pt-4">
                    @endif
                <div class="col-sm-4 pb-4">
                        <div class="card kartica"><a href="kategorija/{{$kategorija->id}}">
                                <div class="kartica-vrh" style="background-image: url('{{asset($kategorija->image)}}');">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title text-center"> <a class="prod-link"
                                        href="kategorija/{{$kategorija->id}}">{{$kategorija->name}}</a></h4>
                                        
                                        <a href="kategorija/{{$kategorija->id}}" class="btn btn-sm gumb">Pogledaj -></a>
                            </div>
                        </div>
                    </div>
                    @if ($i == 3)
                </div>
                @endif
                @php
                if ($i == 3) {
                $i = 0;
                }
                @endphp
                @endforeach         
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
    @endsection