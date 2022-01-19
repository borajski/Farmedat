@extends('back.layouts.back-master')
@section('content')
<h4>Inbox
        <small>
            <span class="pl-2">({{ $messages->count() }})</span>
            <span class="akcija">
                <a href="" class="btn btn-sm btn-primary ml-30" data-toggle="modal" data-target="#novaPoruka">
                      <i class="fas fa-plus-circle"></i> Nova Poruka
                </a>
            </span>
        </small>
    </h4>
    <div class="table-responsive-sm">
    <table class="table table-hover bg-light shadow">
      <thead class="thead t-head" >
        <tr>
          <th>#</th>
          <th>Tema</th>
          <th>Korisnik</th>
          <th>Od/prema</th>            
          <th>Datum</th>
        </tr>
      </thead>
      <tbody>
      @foreach($messages as $key => $message)
        <tr>
          <td>{{ $key + 1 }}</td>
            <td><a href="{{route('message.show',$message->id)}}">{{ $message->subject }}</a></td>
            <td>
              @if ($message->sender->id == auth()->user()->id)
                <small>
                    {{ $message->recipient->name }}
                  </small>
              @else
                <small>
                {{ $message->sender->name }}
              </small>
              @endif
            </td>
          <td>
            @if ($message->sender->id == auth()->user()->id)
              <span style="color:blue;"> <i class="fas fa-arrow-right"></i></span>
            @else
              <span style="color:red;"><i class="fas fa-arrow-left"></i></span>
            @endif
          </td>
          <td><small>{{ date_format(date_create($message->created_at), 'h:i d.m.Y.') }}</small></td>

        </tr>
    @endforeach
      </tbody>
    </table>
  </div> 
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
            <label for="name"><b>Za:</b></label>
            <input type="text" class="form-control" name="ime" id="ime">
            <input type="hidden" class="form-control" name="recipient" id="recipient">
            <input type="hidden" class="form-control" name="parent" value="0">
        </div>
        <div class="form-group">
            <label for="name"><b>Tema:</b></label>
            <input type="text" class="form-control" name="subject">
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
@section('js_after')
<script type="text/javascript">
      $('#ime').change(function(){
          var korisnik = $(this).val();
          if(korisnik){
              $.ajax({
                  type:"GET",
                  url:"{{url('getUserId')}}?ime="+korisnik,
                  success:function(res){
                      if(res != "0"){
                            $("#recipient").val(res);
                      }
                      else{
                          // $("#ime").val("Korisnik ne postoji");
                          alert('Korisnik pod imenom '+korisnik+' nije registiran u našem sustavu.')
                          $("#ime").val("Korisnik ne postoji");
                      }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
              });
          }else{
              $("#ime").empty();

          }
      });
  </script>
@endsection
