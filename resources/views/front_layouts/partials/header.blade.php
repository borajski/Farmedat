@php
$grupe = App\Models\Group::orderBy('redni')->get();
@endphp
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">farmed@</a>
    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav srednji-linkovi">
            @foreach ($grupe as $grupa)
            @if ($grupa->live == 'da')
            @php
            $kategorije = $grupa->categories;
            @endphp
            <li class="nav-item">
                <a class="nav-link" href="/grupa/{{$grupa->id}}">{{$grupa->name}}</a>
            </li>
            @endif
            @endforeach
            
        </ul>        
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
            </li>    
            <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="#" id="prijava" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="prijava">
        @if (Route::has('login'))
         @auth
          <a class="dropdown-item" href="{{ url('/home') }}">Moj profil</a>        
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Odjava</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
          @else
          <a class="dropdown-item" href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
          <a class="dropdown-item" href="{{ route('register') }}">Register</a>
          @endif
          @endauth
          @endif
        </div>
      </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="kosarica" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-cart"></i>
             @if (session('cart'))  
             <span class="badge badge-pill badge-danger"><small>{{ count((array) session('cart')) }}</small>
            </span>
            @endif
        </a>
          <div class="dropdown-menu dropdown-menu-right kosarica" aria-labelledby="kosarica">
          <div class="row">
          <?php $total = 0 ?>
                            @foreach((array) session('cart') as $id => $details)
                            <?php $total += $details['price'] * $details['quantity'] ?>
                            @endforeach
                @if ($total > 0)
                            <div class="col-lg-6 col-sm-6 col-6">
                                <p><strong>Ukupno:</strong> <span class="text-info">{{ $total }} kn</span></p>                                
                            </div>
                @else
                <div class="col-lg-12 col-sm-12 col-12">
                 <p class="text-center"><strong>Vaša košarica je prazna!</strong></p>
</div>
                 @endif
                            
          </div>
          @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <div class="row pb-2">
                            <div class="col-lg-4 col-sm-4 col-4">
                                <img class="img-fluid" src="{{ asset($details['photo']) }}" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8">
                                <p>{{ $details['name'] }}<br>
                                Cijena: <span class="text-info">{{ $details['price'] }}kn</span> <span class="count">
                                    Količina:{{ $details['quantity'] }}</span></p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="row">
                            @if (count((array) session('cart')) > 0)
                            <div class="col-lg-12 col-sm-12 col-12 text-center">
                                <a href="{{ url('kosarica') }}" class="btn btn-block gumb-kartica" style="color: white;">Detalji</a>
                            </div>
                            @endif
                        </div>

               </div>
      </li>
            </li>
        </ul>
 </nav> 
<div class="container-fluid">
 <div class="row redak">

  
        <a href="#">Krug povjerenja </a>|<a href="#">Priključite se </a>|<a href="/izlog-prodavaca">Prodavači </a>|<a href="#">Blog
        </a>
    </div>
</div>