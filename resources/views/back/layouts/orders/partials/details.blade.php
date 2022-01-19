<h5 class="text-black mb-0 mt-20">Informacije o kupcu</h5>
<br>
<h6 class="text-black">Platitelj</h6>
<hr class="mb-30">
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Ime</small><br>
    <b>  {{$narudzba->payment_fname}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Prezime</small><br>
    <b>  {{$narudzba->payment_lname}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <p>
      <small>Adresa</small><br>
    <b>  {{$narudzba->payment_address}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Broj pošte</small><br>
    <b>  {{$narudzba->payment_zip}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Mjesto</small><br>
    <b>  {{$narudzba->payment_city}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Telefon</small><br>
    <b>  {{$narudzba->payment_phone}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Email</small><br>
    <b>  {{$narudzba->payment_email}}</b>
    </p>
  </div>
</div>
<h6 class="text-black">Adresa isporuke</h6>
<hr class="mb-30">
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Ime</small><br>
    <b>  {{$narudzba->shipping_fname}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Prezime</small><br>
    <b>  {{$narudzba->shipping_lname}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <p>
      <small>Adresa</small><br>
    <b>  {{$narudzba->shipping_address}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Broj pošte</small><br>
    <b>  {{$narudzba->shipping_zip}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Mjesto</small><br>
    <b>  {{$narudzba->shipping_city}}</b>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <p>
      <small>Telefon</small><br>
    <b>  {{$narudzba->shipping_phone}}</b>
    </p>
  </div>
  <div class="col-md-6">
    <p>
      <small>Email</small><br>
    <b>  {{$narudzba->shipping_email}}</b>
    </p>
  </div>
</div>
<br>
