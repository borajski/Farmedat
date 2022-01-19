@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
$proizvodi = $prodavac->products;
@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="display-4 text-center mt-3 mb-0">{{$prodavac->name}}</h2>
                <p class="text-muted h3 text-center mt-3 mb-4">{{$prodavac->address}}<br>{{$prodavac->city}}<br>Web:</p>
                <div class="naslovna-slika" style="background-image:url('{{asset($prodavac->cover)}}');">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5 text-center">
        <div class="row">
            <div class="col-md-8 offset-md-2 px-4">
                <div class="krug mb-4">
                    @auth
                    @php
                    $isFollower = App\Models\Follower::where('vendor_id',$prodavac->id) ->
                    where('follower',auth()->user()->id)->first();
                    @endphp
                    @if ($isFollower)
                    <h5>Prodavač je u krugu povjerenja</h5>
                    @else
                    <h5>Dodaj prodavača u krug povjerenja</h5>
                    <a href="/spremi/{{$prodavac->id}}" class="button btn-lg gumb">Moj krug</a>
                    @endif
                    @endauth
                </div>
                <div class="opis">

                    @php
                    echo $prodavac->description;
                    @endphp
                    <a href="" class="btn btn-sm btn-primary ml-30" data-toggle="modal" data-target="#novaPoruka">
                      <i class="fas fa-plus-circle"></i> Nova Poruka
                </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 px-4">
                <div class="naslov mb-4">
                <h3 class="text-center"><strong>Proizvodi</strong></h3>
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
                                <div class="kartica-vrh" style="background-image: url('{{asset($proizvod->image)}}');">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title text-center"> <a class="prod-link"
                                        href="/proizvod/{{$proizvod->id}}">{{$proizvod->name}}</a></h4>
                                <p class="card-text text-center"><strong>{{$proizvod->price}} kn</strong></p>
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
</section>
    <!-- Modal za slanje nove poruke-->
    <div class="modal fade" id="novaPoruka" tabindex="-1" role="dialog" aria-hidden="true">
  <!-- form start -->
  <form enctype="multipart/form-data" action="{{ route('message.store') }}" method="POST">
    {{ csrf_field() }}
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nova poruka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
      <div class="col-md-12">
        <div class="form-group">
            <label for="name"><b>Tema:</b></label>
            <input type="text" class="form-control" name="subject">
            <input type="hidden" class="form-control" name="recipient" value="{{$prodavac->id}}">
            <input type="hidden" class="form-control" name="parent" value="0">
        </div>
          <div class="form-group">
              <label for="description"><b>Poruka:</b></label>
              <textarea class="form-control" rows="10" name="message_content" style="width: 100%"></textarea>
          </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Pošalji</button>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection