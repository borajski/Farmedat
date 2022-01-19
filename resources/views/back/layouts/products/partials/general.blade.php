@section('js_before')
<script src="{{ asset('js/previewImages.js') }}"></script>
<script src="{{ asset('js/previewPhoto.js') }}"></script>
<!-- text editor -->
<!-- general form elements -->
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
 <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
@endsection
<h5 class="text-black mb-0 mt-20">Opće informacije</h5>
<hr class="mb-30">
<div class="form-group">
    <label for="name">Naziv proizvoda: @include('back.layouts.partials.required-star')</label>
    <input type="text" class="form-control" name="name" id="ime" value="{{$ime}}">
    <input type="hidden" class="form-control" name="vendor" value="{{$vendor}}">
</div>
<div class="form-group">
    <label for="opis">Opis proizvoda: @include('back.layouts.partials.required-star')</label>
    <textarea class="form-control" rows="10" name="description" style="width: 100%">{{$opis}}</textarea>
</div>
<div class="form-group">
    <label for="name">SKU broj: @include('back.layouts.partials.required-star')</label>
    <input type="text" class="form-control" name="sku" value="{{$sku}}">
</div>
<div class="form-group">
    <label for="name">Kategorija: @include('back.layouts.partials.required-star')</label>
    <select name="category" class="form-control" id="kategorija">
         <option value="{{$kategorija_id}}" selected>{{$kategorija_ime}}</option>
      @foreach ($kategorije as $kategorija)
           <option value="{{$kategorija->id}}">{{$kategorija->name}}</option>
       @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Podkategorija: @include('back.layouts.partials.required-star')</label>
    <select class="form-control" id="vrsta" name="subcategory">
                      <option value="{{$podkategorija_id}}" selected>{{$podkategorija_ime}}</option>

                  </select>
</div>
<br>
@section('js_after')
    <script type="text/javascript">
        $('#kategorija').change(function(){
            var katID = $(this).val();
            if(katID){
                $.ajax({
                    type:"GET",
                    url:"{{url('dajvrstu')}}?kat_id="+katID,
                    success:function(res){
                        if(res){
                            $("#vrsta").empty();
                            $("#vrsta").append('<option>Select</option>');
                            $.each(res,function(key,value){
                              $("#vrsta").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#vrsta").empty();
                        }
                    }
                });
            }else{
                $("#vrsta").empty();

            }
        });
    </script>
@endsection
