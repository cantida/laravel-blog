<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="index.html">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto py-4 py-lg-0">
        <li class="nav-item">
          <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">Home</a>
        </li>
        @guest
          <li class="nav-item">
            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">Register</a>
          </li>
        @endguest
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              My Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('my-blogs') }}">My Blogs</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
              {{-- @role('admin')
              <li class="nav-item">
                <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('manage-blogs') }}">Admin Panel</a>
              </li>
              @endrole --}}
            </ul> 
          </li>
        @endauth
        @if (auth()->check() && auth()->user()->hasRole('admin'))
          <li class="nav-item">
            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('admin-manage-blogs') }}">Admin Panel</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>