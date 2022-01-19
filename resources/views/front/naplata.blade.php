@extends('front.layout')

@section('title', 'Naplata')

@section('content')
@include('back.layouts.partials.sessions')
@php
$user = auth()->user();
@endphp
<div class="container">
    <h2>Naplata</h2>
    <br>
    <form enctype="multipart/form-data" action="{{route('order.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#platitelj">Podaci o platitelju</a>
                    </h4>
                </div>
                <div id="platitelj" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <i class="fa fa-user"></i> Adresa naplate
                                <label class="pull-right">
                                    <input name="same_as_user_address" type="checkbox" id="same-as-user" value=""> Ista
                                    kao adresa korisnika</label>
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
                                    <input type="text" name="pay_address" id="pay_address" class="form-control"
                                        value="">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Poštanski broj:
                                                @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="pay_zip" id="pay_zip" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Grad: @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="pay_city" id="pay_city" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Broj telefona:
                                                @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="pay_phone" id="pay_phone" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email: @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="pay_email" id="pay_email" class="form-control"
                                                value="">
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
                                <label class="pull-right">
                                    <input name="same_as_pay_address" type="checkbox" id="same-as-pay" value=""> Ista
                                    kao adresa platitelja</label>
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
                                    <input type="text" name="ship_address" id="ship_address" class="form-control"
                                        value="">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Poštanski broj:
                                                @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="ship_zip" id="ship_zip" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Grad: @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="ship_city" id="ship_city" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Broj telefona:
                                                @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="ship_phone" id="ship_phone" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email: @include('back.layouts.partials.required-star')</label>
                                            <input type="text" name="ship_email" id="ship_email" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Payment info -->
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-lock"></i> Način plaćanja</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12"><label>Izaberi način plaćanja:</label></div>
                            <div class="col-md-12">
                                <select id="CreditCardType" name="payment" class="form-control">
                                    <option value="cash">Gotovina</option>
                                    <option value="transfer">Bankovni transfer</option>
                                    <option value="card">Kartica</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $total = 0;
                    $i = 0;
                    @endphp

                    @if(session('cart'))
                    @foreach(session('cart') as $id => $details)

                    @php
                    $total += $details['price'] * $details['quantity'];
                    $i++;
                    @endphp

                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="100"
                                        height="100" class="img-responsive" /></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    <input type="hidden" name="prod_id{{$i}}" value="{{$details['prod_id']}}">
                                    <input type="hidden" name="vendor_id" value="{{$details['vendor_id']}}">
                                    <input type="hidden" name="name{{$i}}" value="{{$details['name']}}">
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}
                            <input type="hidden" name="price{{$i}}" value="{{$details['price']}}">
                        </td>
                        <td data-th="Quantity">
                            <input type="number" name="quantity{{$i}}" value="{{ $details['quantity'] }}"
                                class="form-control quantity" />
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i
                                    class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i
                                    class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
                <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total {{ $total }}</strong>
                            <input type="hidden" name="total" value="{{$total}}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong><br>
                            <input type="hidden" name="broj_proizvoda" value="{{$i}}">
                            <button type="submit" class="btn btn-warning">Naruči</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
    </form>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(".update-cart").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    $.ajax({
        url: '{{ url('
        update - cart ') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.attr("data-id"),
            quantity: ele.parents("tr").find(".quantity").val()
        },
        success: function(response) {
            window.location.reload();
        }
    });
});

$(".remove-from-cart").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    if (confirm("Are you sure")) {
        $.ajax({
            url: '{{ url('
            remove - from - cart ') }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.attr("data-id")
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
<script>
$(() => {
    const checkbox = document.getElementById('same-as-user')
    checkbox.addEventListener('change', (e) => {
        if (e.target.checked) {
            $('#pay_fname').val('{{ isset($user->details) ? $user->details->fname : '
                ' }}')
            $('#pay_lname').val('{{ isset($user->details) ? $user->details->lname : '
                ' }}')
            $('#pay_address').val('{{ isset($user->details) ? $user->details->address : '
                ' }}')
            $('#pay_zip').val('{{ isset($user->details) ? $user->details->zip : '
                ' }}')
            $('#pay_city').val('{{ isset($user->details) ? $user->details->city : '
                ' }}')
            $('#pay_phone').val('{{ isset($user->details) ? $user->details->phone : '
                ' }}')
            $('#pay_email').val('{{ isset($user) ? $user->email : '
                ' }}')
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
</script>
<script>
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