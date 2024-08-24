<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 px-3">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  @auth
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('friend.index') }}">Friends</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('friend.request_view') }}">Request</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
      <a href="#">
        <img src="{{ asset('asset/profile_pic/' . auth()->user()->profile_pic) }}" class="imgProfile" alt="">
      </a>
      <p class="m-0">{{ auth()->user()->name }}</p>
  @endauth
  @guest
      <a href="" class="ms-auto">
        <button class="btn btn-primary">Login</button>
      </a>
  @endguest
</nav>