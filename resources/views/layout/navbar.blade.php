<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 px-3">
  <a class="navbar-brand" href="#">{{ __('messages.navbar') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('messages.toggle_navigation') }}">
    <span class="navbar-toggler-icon"></span>
  </button>

  @auth
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link @yield('homeA')" href="{{ route('home.index') }}">{{ __('messages.home') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('friendA')" href="{{ route('friend.index') }}">{{ __('messages.friends') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('requestA')" href="{{ route('friend.request_view') }}">{{ __('messages.request') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('shopA')" href="{{ route('avatar.index') }}">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('topupA')" href="{{ route('topup.show') }}">Topup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('myavatarA')" href="{{ route('myavatar.show') }}">Avatar</a>
      </li>
    </ul>
  </div>

  <a href="{{ route('user.profile') }}" class="d-flex align-items-center">
    <img src="{{ asset('asset/profile_pic/' . auth()->user()->profile_pic) }}" class="imgProfile rounded-circle" alt="{{ __('messages.profile_picture') }}">
    <span class="ms-2" style="text-decoration: none; color: black;" class="text-underline-none">{{ auth()->user()->name }}</span>
  </a>

  <div class="dropdown ms-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      @if(session('locale') == 'id')
        {{ __('messages.indonesian') }}
      @else
        {{ __('messages.english') }}
      @endif
    </button>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('locale', 'id') }}">{{ __('messages.indonesian') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('locale', 'en') }}">{{ __('messages.english') }}</a></li>
    </ul>
  </div>

  @endauth
  @guest
  <a href="{{ route('session.initR') }}" class="ms-auto">
    <button class="btn btn-primary">{{ __('messages.login') }}</button>
  </a>
  @endguest
</nav>
