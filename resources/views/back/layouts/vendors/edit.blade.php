@extends('back.layouts.back-master')
@section('js_before')
<script src="{{ asset('js/previewPhoto.js') }}"></script>
@endsection
@section('content')
    <!-- text editor -->
    <!-- general form elements -->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Podaci o prodavaču</h3>
          </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form enctype="multipart/form-data" action="{{ route('vendor.update', $prodavac->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('patch') }}
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Odaberi novu naslovnu fotografiju:</label>
                      <br>
                      <img class="card-img-top" id="previewImg" src="{{asset($prodavac->cover)}}" alt="Card image">
                      <input type="file" class="form-control-file"  name="cover" onchange="previewFile(this);">
                  </div>
                <div class="col-md-6">
                  <div class="form-group align-center">
                   <label for="exampleFormControlFile1">Odaberi novi logo:</label>
                   <br>
                    <img class="align-center img-responsive img-thumbnail" name="image" id="previewImg" src="{{asset($prodavac->logo)}}" align="middle" width="250" alt="">
                    <input type="file" class="form-control-file"  name="image" onchange="previewFile(this);">
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="opis"><b>Opis:</b></label>
                        <textarea class="form-control" rows="10" name="description" style="width: 100%">{{$prodavac->description}}</textarea>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="name"><b>Naziv: @include('back.layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="name" value="{{$prodavac->name}}">
                </div>
                <div class="form-group">
                    <label for="name"><b>OIB: @include('back.layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="oib" value="{{$prodavac->oib}}">
                </div>
                <div class="form-group">
                    <label for="adresa"><b>Adresa: @include('back.layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="address" value="{{$prodavac->address}}">
                </div>
                <div class="form-group">
                    <label for="mjesto"><b>Mjesto: @include('back.layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="city" value="{{$prodavac->city}}">
                </div>  <div class="form-group">
                    <label for="posta"><b>Broj pošte:</b></label>
                    <input type="text" class="form-control" name="zip" value="{{$prodavac->zip}}">
                </div>
                <div class="form-group">
                    <label for="adresa"><b>Longitude:</b></label>
                    <input type="text" class="form-control" name="longitude" value="{{$prodavac->longitude}}">
                </div>
                <div class="form-group">
                    <label for="adresa"><b>Latitude:</b></label>
                    <input type="text" class="form-control" name="latitude" value="{{$prodavac->latitude}}">
                </div>
                <div class="form-group">
                    <label for="djelatnost"><b>Djelatnost: @include('back.layouts.partials.required-star')</b></label>
                   <select name="interes" class="form-control">
                        <option value="{{$prodavac->interes}}" selected>{{$prodavac->interes}}</option>
                        <option value = "OPG">OPG</option>
                        <option value = "Ugostiteljstvo">Ugostiteljstvo</option>
                        <option value = "Turizam">Turizam</option>
                        <option value = "Prerađivači">Prerađivači</option>
                        <option value = "Repromaterijal">Repromaterijal</option>
                        <option value = "Umjetna gnojiva">Umjetna gnojiva</option>
                        <option value = "Zaštitna sredstva">Zaštitna sredstva</option>
                        <option value = "Mehanizacija">Mehanizacija</option>
                        <option value = "Distributeri">Distributeri</option>
                        <option value = "Prijevoznici">Prijevoznici</option>
                        <option value = "Veterinari">Veterinari</option>
                    </select>
                </div>
                @if (auth()->user()->details->role == "admin")
                <div class="form-group">
                    <label for="plan"><b>Multivendor plan:</b></label>
                    <input type="text" class="form-control" name="plan" value="{{$prodavac->plan_id}}">
                </div>
             <div class="form-group">
               <label for="javnost"><b>On/off line</b></label>
              <br>
              <label class="switch">
              @if ($prodavac->live == "ne")
              <input type="checkbox" name="live">
              @else
              <input type="checkbox" name="live" checked>
              @endif
              <span class="slider"></span>
              </label>
                    </div>
              @else
                <div class="form-group">
                 <input type="hidden" class="form-control" name="plan" value="{{$prodavac->plan_id}}">
               </div>
              @endif


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Spremi</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

@endsection
