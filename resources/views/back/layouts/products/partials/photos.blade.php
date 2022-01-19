<h5 class="text-black mb-0 mt-20">Fotografije proizvoda</h5>
<hr class="mb-30">
<div class="form-group align-center">
  <label for="image">Glavna fotografija proizvoda</label>
  <br>
  <img class="align-center img-responsive img-thumbnail" id="previewImg" name="image" src="{{asset($slika)}}" align="middle" width="250" alt="">
  <input type="file" class="form-control-file" name="image" onchange="previewFile(this);">
</div>
<div class="form-group">

  <label for="image">Dodatne fotografije proizvoda</label>
  <br>
  @if (isset($slike))
   <div class="flex-container">
     @foreach ($slike as $foto)
    <div class="col-col1">
      <div class="img">
        <img class="img-responsive img-thumbnail" src="{{asset($foto->image)}}" style="height:200px;">
        <a href="brisiSliku/{{$foto->id}}"><span class="xmark" title="obriši">
          <i class="fas fa-trash-alt">
          </i>
        </span>
      </a>
    </div>
  </div>
     @endforeach
   </div>
     @endif

    <div class="col-12 text-center p-4"  id="image_preview">  </div>
      <input type="file" class="form-control-file" id="images" name="images[]" onchange="preview_images();" multiple/>
 </div>
 <hr class="mb-30">
  <div class="form-group">
     <label for="javnost"><b>On/off line</b></label>
    <br>
    <label class="switch">
    @if ($online == "da")
    <input type="checkbox" name="live" checked>
    @else
    <input type="checkbox" name="live">
    @endif
    <span class="slider"></span>
    </label>
   </div>
