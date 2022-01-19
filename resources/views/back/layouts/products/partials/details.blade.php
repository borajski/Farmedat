<h5 class="text-black mb-0 mt-20">Detalji</h5>
<hr class="mb-30">
<div class="form-group">
    <label for="name">Cijena:</label>
    <input type="text" class="form-control" name="price" value="{{$cijena}}">
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
        <label for="name">Jedinica mjere:</label>
        <select class="form-control" name="measure_unit" style="width: 100%;">
                    <option value="{{$jedinica}}">{{$jedinica}}</option>
                    @foreach (['kom', 'g', 'dkg', 'kg', 't', 'ml', 'dcl', 'l'] as $mjera)
                      @if ($mjera != $jedinica)
                        <option value="{{$mjera}}">{{$mjera}}</option>
                      @endif
                    @endforeach
                </select>
      </div>
  </div>
<div class="col-sm-6">
<div class="form-group">
    <label for="name">Količina:</label>
    <input type="text" class="form-control" name="quantity" value="{{$kolicina}}">
</div>
</div>
</div>
<div class="form-group">
    <label for="name">Vrsta dostave:</label>
    <select class="form-control" name="delivery" style="width: 100%;">
                <option value="{{$dostava}}">{{$dostava}}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach (['prodavač dostavlja', 'kupac preuzima', 'dostavna služba', 'poštanska usluga'] as $delivery)
                @if ($delivery != $dostava)
                  <option value="{{$delivery}}">{{$delivery}}</option>
                @endif    @endforeach
            </select>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
          <label for="name">Minimalna narudžba:</label>
          <input type="text" class="form-control" name="min_order" value="{{$minimum}}">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
          <label for="name">Cijena dostave:</label>
          <input type="text" class="form-control" name="del_price" value="{{$cijena_dostave}}">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
          <label for="name">Dostava uključena u cijenu:</label>
          <select class="form-control" name="del_in_price" style="width: 100%;">
                <option value="{{$dostava_in}}" selected>{{$dostava_in}}</option>
                @if ($dostava_in == "Da")
                  <option value="Ne">Ne</option>
                @elseif ($dostava_in == "")
                  <option value="Da">Da</option>
                  <option value="Ne" selected>Ne</option>
                @else
                    <option value="Da">Da</option>
                @endif
          </select>
        </div>
    </div>
    <br>
  </div>
<br>
