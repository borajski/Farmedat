@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
$podkategorije = $kategorija->subcategories;
@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-center mt-3 mb-0">{{$kategorija->name}}</h2>
                <p class="text-muted h3 text-center mt-3 mb-4">{{$kategorija->description}}</p>
                <div class="naslovna-slika" style="background-image:url('{{asset($kategorija->image)}}');">
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
                    @foreach ($podkategorije as $podkategorija)
                    @if ($podkategorija->live == 'da')
                    <a href="podkategorija/{{$podkategorija->id}}">{{$podkategorija->name}}</a>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="naslov mb-4">
                    <h3 class="text-center">Podkategorije</h3>
                </div>
                @foreach ($podkategorije as $podkategorija)
                @php
                $i++;
                @endphp
                @if ($i == 1)
                <div class="row pt-4">
                    @endif
                    <div class="col-sm-4 pb-4">
                        <div class="card kartica"><a href="podkategorija/{{$podkategorija->id}}">
                                <div class="kartica-vrh"
                                    style="background-image: url('{{asset($podkategorija->image)}}');">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title text-center"> <a class="prod-link"
                                        href="podkategorija/{{$podkategorija->id}}">{{$podkategorija->name}}</a></h4>

                                <a href="podkategorija/{{$podkategorija->id}}" class="btn btn-sm gumb">Pogledaj -></a>
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