<nav id="sidebar">
    <div class="sidebar-header">
        <h3 class="text-center"><a href="/">farmed@</a></h3>
        <strong><a href="/">f@</a></strong>
      </div>
         <div class="text-center">
        <a href="/profile">
        @if (auth()->user()->details)
        <img src="{{ asset(auth()->user()->details->avatar) }}" class="profile_image" alt="">
        @else
       <img src="{{ asset('images/users/default-avatar.png') }}" class="profile_image" alt="">
        @endif
        <p>{{auth()->user()->name}}</p>
      </a>
      </div>


    <ul class="list-unstyled components">
        <li>
            <a href="/home">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
          </li>
      @if (isset(auth()->user()->details))
      @if (auth()->user()->details->role != 'customer')
        <li>
            <a href="/grupe">
                <i class="fas fa-stream"></i>
                Kategorije
            </a>
        </li>        
        <li>
          <a href="#proizvodi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-cogs"></i>
                Proizvodi
          </a>
            <ul class="collapse list-unstyled" id="proizvodi">
              <li>
                  <a href="/proizvodi">Pregled</a>
              </li>
              <li>
                  <a href="/proizvodi_akcije">Akcije</a>
              </li>
            </ul>
        </li>
        @endif
        <li>
            <a href="/naruceno">
                <i class="fas fa-shopping-basket"></i>
                Naručeno
            </a>
        </li>
        @if (auth()->user()->details->role != 'customer')
        <li>
            <a href="/narudzbe">
                <i class="fas fa-truck-loading"></i>
                Narudžbe
            </a>
        </li>
        @endif
        @if (auth()->user()->details->role == 'admin')
        <li>
          <a href="#korisnici" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-users"></i>
              Korisnici
          </a>
          <ul class="collapse list-unstyled" id="korisnici">
              <li>
                  <a href="/korisnici">Pregled</a>
              </li>
              <li>
                  <a href="/prodavaci">Prodavači</a>
              </li>
              <li>
                  <a href="#">I-deeye</a>
              </li>
          </ul>
      </li>
      @else
      @if (auth()->user()->details->role == 'vendor')     
      <li>
        <a href="#korisnici" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-users"></i>
            Moj krug
        </a>
        <ul class="collapse list-unstyled" id="korisnici">
            <li>
                <a href="/pratim">Pratim</a>
            </li>
            <li>
                <a href="/kupci">Kupci</a>
            </li>
            <li>
                <a href="/pratnja">Prate me</a>
            </li>
        </ul>
    </li>
    @endif
    @if (auth()->user()->details->role == 'customer') 
    <li>
            <a href="/pratim">
                <i class="fas fa-users"></i>
                Moj krug
            </a>
        </li>
    @endif
     @endif

              <li>
            <a href="/poruke">
                <i class="fas fa-paper-plane"></i>
                Poruke
            </a>
        </li>
  @endif
    </ul>

</nav>
