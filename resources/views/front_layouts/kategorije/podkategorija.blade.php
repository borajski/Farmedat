@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
$proizvodi = App\Models\Product::where('subcategory',$podkategorija->id)->get();
@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-center mt-3 mb-0">{{$podkategorija->name}}</h2>
                <p class="text-muted h3 text-center mt-3 mb-4">{{$podkategorija->description}}</p>
                <div class="naslovna-slika" style="background-image:url('{{asset($podkategorija->image)}}');">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-4">
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-3">
                <h4>Proizvođači</h4>
                <div class="sidenav">
                 @php
                 $vendor = array();
                 
                 foreach ($proizvodi as $proizvod)
                  {
                  if  ($proizvod->live == 'da')
                    {
                      $vendor[$proizvod->vendor->id] = $proizvod->vendor->name;
                    }
                  }
                  $vendor = array_unique($vendor);
                @endphp
                    @foreach ($vendor as $ime)
                    <a href="/prodavac/{{key($vendor)}}">{{$ime}}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="naslov mb-4">
                    <h3 class="text-center">Proizvodi</h3>
                </div>
                @foreach ($proizvodi as $proizvod)
                @php
                $i++;
                @endphp
                @if ($i == 1)
                <div class="row pt-4">
                    @endif
                    <div class="col-sm-4 pb-4">
                        <div class="card kartica"><a href="/proizvod/{{$proizvod->id}}">
                                <div class="kartica-vrh"
                                    style="background-image: url('{{asset($proizvod->image)}}');">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title text-center"> <a class="prod-link"
                                        href="/proizvod/{{$proizvod->id}}">{{$proizvod->name}}</a></h4>
                                        <p><strong>{{$proizvod->price}}kn</strong><br>
                                farmed@<strong><a class="prod-link"
                                        href="/prodavac/{{$proizvod->vendor->id}}">{{$proizvod->vendor->name}}</a></strong></p>
                                <a href="/proizvod/{{$proizvod->id}}" class="btn btn-sm gumb">Pogledaj -></a>
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