@extends('front_layouts.front-master')
@section('content')
@php
$i = 0;
$user = auth()->user();
@endphp
<section>
<form enctype="multipart/form-data" action="{{route('order.store')}}" method="POST">
        {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 px-4 pt-5">
                <div class="naslov-cart mb-4">
                    <h3 class="text-center">KOŠARICA</h3>
                </div>
                <div class="table-responsive-sm">
                    <table id="cart" class="table table-hover table-borderless bg-light">
                        <thead>
                            <tr style="background-color: #ecebbd; border: none;">
                                <th style="width:50%">Proizvod</th>
                                <th style="width:10%">Cijena kn</th>
                                <th style="width:8%">Popust</th>
                                <th style="width:8%">Količina</th>
                                <th style="width:14%" class="text-center">Ukupno kn</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                            <?php 
                                  $qty = $details['quantity'];
                                  $total += $details['price'] * $qty;
                                  $i++;
                            ?>
                            <tr style="border-bottom: 1px solid #e5e4e2;">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="100"
                                                height="100" class="img-responsive" /></div>
                                        <div class="col-sm-9">
                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                            <input type="hidden" name="prod_id{{$i}}" value="{{ $details['prod_id'] }}">
                                    <input type="hidden" name="vendor_id" value="{{ $details['vendor_id'] }}">
                                    <input type="hidden" name="name{{$i}}" value="{{ $details['name'] }}">
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price" id="cijena{{$i}}">{{ $details['price'] }}                                
                                </td>
                                <input type="hidden" name="price{{$i}}" value="{{$details['price']}}">
                                <td data-th="Discount">{{ $details['discount'] }}%</td>

                                <td data-th="Quantity">
                                    <input type="number" name="quantity{{$i}}" value="{{ $qty }}"
                                        class="form-control quantity" onchange="changeQty(this.value,{{$i}},{{$qty}})" />
                                </td>
                                <td data-th="Subtotal" id="subtotal{{$i}}" class="text-center">
                                    {{ $details['price'] * $details['quantity'] }}</td>
                                <td class="actions" data-th="">

                                    <button class="btn btn-danger btn-sm" data-id="{{ $id }}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr style="border-bottom: 3px solid #e5e4e2;border-top: 3px solid #e5e4e2;">
                                <td colspan="4"><strong>SVEUKUPNO</strong></td>
                                <td class="text-center"><strong id="sveukupno">{{ $total }}</strong></td>
                                <input type="hidden" name="total" id="za_platiti" value="{{$total}}">
                            </tr>
                            <tr>
                                <td colspan="4"><a href="{{ url('/') }}" class="btn btn-warning"><i
                                            class="fa fa-angle-left"></i> Nastavi kupovati</a></td>
                                
                                <td colspan="2" class="text-right">
                                    <a href="#naplata" class="btn btn-warning">Plaćanje <i
                                            class="fa fa-angle-right"></i></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
<section id="naplata">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 px-4 pt-5">
                <div class="naslov-cart mb-4">
                    <h3 class="text-center">PLAĆANJE</h3>
                </div>
                
                <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading bg-light">
        <h4 class="panel-title" style="background-color: #ecebbd;">
          <a data-toggle="collapse" data-parent="#accordion" href="#platitelj">Podaci o platitelju</a>
        </h4>
      </div>
      <div id="platitelj" class="panel-collapse collapse in">
        <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <i class="fa fa-user"></i> Adresa naplate
            <label class="float-right">
            <input name="same_as_user_address" type="checkbox" id="same-as-user" value=""> Ista kao adresa korisnika</label>
            <div class="form-group">
              <label>Ime: @include('back.layouts.partials.required-star')</label>
              <input type="text" name="pay_fname" id="pay_fname" class="form-control" value="">
            </div>
            <div class="form-group">
              <label>Prezime: @include('back.layouts.partials.required-star')</label>
              <input type="text" name="pay_lname" id="pay_lname" class="form-control" value="">
            </div>
            <div class="form-group">
              <label>Prezime: @include('back.layouts.partials.required-star')</label>
              <input type="text" name="pay_address" id="pay_address" class="form-control" value="">
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Poštanski broj: @include('back.layouts.partials.required-star')</label>
                  <input type="text" name="pay_zip" id="pay_zip" class="form-control" value="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Grad: @include('back.layouts.partials.required-star')</label>
                  <input type="text" name="pay_city" id="pay_city" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Broj telefona: @include('back.layouts.partials.required-star')</label>
                  <input type="text" name="pay_phone" id="pay_phone" class="form-control" value="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email: @include('back.layouts.partials.required-star')</label>
                  <input type="text" name="pay_email" id="pay_email" class="form-control" value="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading bg-light">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#narucitelj">Podaci o naručitelju</a>
        </h4>
      </div>
      <div id="narucitelj" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <i class="fa fa-truck"></i> Adresa isporuke
              <label class="float-right">
              <input name="same_as_pay_address" type="checkbox" id="same-as-pay" value=""> Ista kao adresa platitelja</label>
              <div class="form-group">
                <label>Ime: @include('back.layouts.partials.required-star')</label>
                <input type="text" name="ship_fname" id="ship_fname" class="form-control" value="">
              </div>
              <div class="form-group">
                <label>Prezime: @include('back.layouts.partials.required-star')</label>
                <input type="text" name="ship_lname" id="ship_lname" class="form-control" value="">
              </div>
              <div class="form-group">
                <label>Prezime: @include('back.layouts.partials.required-star')</label>
                <input type="text" name="ship_address" id="ship_address" class="form-control" value="">
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Poštanski broj: @include('back.layouts.partials.required-star')</label>
                    <input type="text" name="ship_zip" id="ship_zip" class="form-control" value="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Grad: @include('back.layouts.partials.required-star')</label>
                    <input type="text" name="ship_city" id="ship_city" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Broj telefona: @include('back.layouts.partials.required-star')</label>
                    <input type="text" name="ship_phone" id="ship_phone" class="form-control" value="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email: @include('back.layouts.partials.required-star')</label>
                    <input type="text" name="ship_email" id="ship_email" class="form-control" value="">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
  </div>
  <h4 class="panel-title">Način plaćanja</h4>
  <div class="row isporuka">
                 
                  <!-- Payment info -->
            <div class="col-md-6">
                
                    <div class="panel-heading"><i class="fa fa-lock"></i> Način plaćanja</div>
                    
                        <div class="form-group">
                            <label>Izaberi način plaćanja:</label>                            
                                <select id="CreditCardType" name="payment" class="form-control">
                                    <option value="cash">Gotovina</option>
                                    <option value="transfer">Bankovni transfer</option>
                                    <option value="card">Kartica</option>
                                    <option value="paypal">Paypal</option>
                                </select>                            
                        </div>
</div>
<div class="col-md-6">
<div class="panel-heading"><i class="fa fa-lock"></i> Način dostave</div>
                        <div class="form-group">
                            <label for="name">Vrsta dostave:</label>
                            <select class="form-control" name="delivery" style="width: 100%;">
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach (['prodavač dostavlja', 'kupac preuzima', 'dostavna služba', 'poštanska
                                usluga'] as $delivery)

                                <option value="{{$delivery}}">{{$delivery}}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <input type="hidden" name="broj_proizvoda" value="{{$i}}">                        
                            <button type="submit" class="btn btn-warning float-right">Naruči</button>     
</div>
               


</form>
                </div>
                </div>
                </div>
 
</section>
@endsection
@section('js_after')
<script>
function changeQty(kolicina, i,qty) {
    var element1 = "cijena" + i;
    var element2 = "subtotal" + i;
    var broj_proizvoda = document.getElementById("cart").rows.length - 3;
    var zbroj = 0;
        
    subtotal = document.getElementById(element1).innerHTML * kolicina;
    document.getElementById(element2).innerHTML = subtotal;
    for (var j = 1; j <= broj_proizvoda; j++)
    {
      element2 = "subtotal" + j;
      zbroj = zbroj + Number(document.getElementById(element2).innerHTML);
    }
    document.getElementById("sveukupno").innerHTML = zbroj;
    document.getElementById("za_platiti").value = zbroj;
}
$(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
// automatsko popunjavanje obrasca
$(() => {
            const checkbox = document.getElementById('same-as-user')
            checkbox.addEventListener('change', (e) => {
                if (e.target.checked) {
                    $('#pay_fname').val('{{ isset($user->details) ? $user->details->fname : '' }}')
                    $('#pay_lname').val('{{ isset($user->details) ? $user->details->lname : '' }}')
                    $('#pay_address').val('{{ isset($user->details) ? $user->details->address : '' }}')
                    $('#pay_zip').val('{{ isset($user->details) ? $user->details->zip : '' }}')
                    $('#pay_city').val('{{ isset($user->details) ? $user->details->city : '' }}')
                    $('#pay_phone').val('{{ isset($user->details) ? $user->details->phone : '' }}')
                    $('#pay_email').val('{{ isset($user) ? $user->email : '' }}')
                } else {
                    $('#pay_fname').val('')
                    $('#pay_lname').val('')
                    $('#pay_address').val('')
                    $('#pay_zip').val('')
                    $('#pay_city').val('')
                    $('#pay_phone').val('')
                    $('#pay_email').val('')
                }
            })
        })
// automatsko popunjavanje obrasca
$(() => {
          const checkbox = document.getElementById('same-as-pay')

          checkbox.addEventListener('change', (e) => {
              if (e.target.checked) {
                  $('#ship_fname').val($('#pay_fname').val())
                  $('#ship_lname').val($('#pay_lname').val())
                  $('#ship_address').val($('#pay_address').val())
                  $('#ship_zip').val($('#pay_zip').val())
                  $('#ship_city').val($('#pay_city').val())
                  $('#ship_phone').val($('#pay_phone').val())
                  $('#ship_email').val($('#pay_email').val())
              } else {
                  $('#ship_fname').val('')
                  $('#ship_lname').val('')
                  $('#ship_address').val('')
                  $('#ship_zip').val('')
                  $('#ship_city').val('')
                  $('#ship_phone').val('')
                  $('#ship_email').val('')
              }
          })
      })
</script>
@endsection