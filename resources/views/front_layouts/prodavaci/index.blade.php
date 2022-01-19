@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
@endphp
<section>
    <div class="container">
    <div class="m-4">
    <h3 class="text-center"><strong>Proizvođači</strong></h3>
    </div>
    <div>
        @foreach ($prodavaci as $prodavac)
        @php
        $i++;
        @endphp
        @if ($i == 1)
        <div class="row pt-4">
            @endif
            <div class="col-sm-4 pb-4">
                        <div class="card kartica"><a href="/prodavac/{{$prodavac->id}}">
                                <div class="kartica-vrh" style="background-image: url('{{asset($prodavac->logo)}}');">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title text-center"> <a class="prod-link"
                                        href="/prodavac/{{$prodavac->id}}">{{$prodavac->name}}</a></h4>
                                <p class="card-text text-center"><strong>{{$prodavac->city}}</strong></p>
                                <a href="/prodavac/{{$prodavac->id}}" class="btn btn-sm gumb">Pogledaj -></a>
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
     </section>
@endsection