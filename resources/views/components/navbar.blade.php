<nav id="nav">
  @if (App::getLocale() == 'ar')
    <ul class="main-menu nav navbar-nav navbar-left">
      <li><a href="{{ url('/') }}"> {{ __('main.home') }} </a></li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"> {{ __('main.categories') }} <span class="caret"></span></a>
        <ul class="dropdown-menu">

          @foreach ($cats as $cat)
            <li><a href="{{ url("category/$cat->id") }}">{{ $cat->name() }}</a></li>
          @endforeach

        </ul>
      </li>
      <li><a href=" {{ url('contact') }} ">{{ __('main.contact') }} </a></li>

      @guest

        <li><a href=" {{ route('login') }} ">{{ __('main.signin') }}</a></li>
        <li><a href=" {{ route('register') }}"> {{ __('main.signup') }} </a></li>

      @endguest

      @auth

        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if (Auth::user()->role->name == 'student')
              <li>
                <a href="{{ url('/profile') }}"> Profile </a>
              </li>
            @else
              <li><a href="{{ url('/dashboard') }}"> {{ __('main.dashboard') }} </a></li>
            @endif
          </ul>
        </li>

        <li>
          <a id="logout" href="{{ route('logout') }}"> {{ __('main.signout') }} </a>
        </li>

        <li>
          <form id="logout_form" action=" {{ route('logout') }} " method="post" style="display: none;">
            @csrf
          </form>
        </li>
      @endauth

      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"> {{ __('main.lang') }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href=" {{ url('lang/set/ar') }} "> ع </a></li>
          <li><a href=" {{ url('lang/set/en') }}"> en </a></li>
        </ul>
      </li>

    </ul>
  @else
    <ul class="main-menu nav navbar-nav navbar-right">
      <li><a href="{{ url('/') }}"> {{ __('main.home') }} </a></li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"> {{ __('main.categories') }} <span class="caret"></span></a>
        <ul class="dropdown-menu">

          @foreach ($cats as $cat)
            <li><a href="{{ url("category/$cat->id") }}">{{ $cat->name() }}</a></li>
          @endforeach

        </ul>
      </li>
      <li><a href="{{ url('contact') }} ">{{ __('main.contact') }} </a></li>

      @guest

        <li><a href=" {{ route('login') }} ">{{ __('main.signin') }}</a></li>
        <li><a href=" {{ route('register') }}"> {{ __('main.signup') }} </a></li>
      @endguest

      @auth

        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if (Auth::user()->role->name == 'student')
              <li>
                <a href="{{ url('/profile') }}"> Profile </a>
              </li>
            @else
              <li><a href="{{ url('/dashboard') }}"> {{ __('main.dashboard') }} </a></li>
            @endif
          </ul>
        </li>

        <li>
          <a id="logout" href="{{ route('logout') }}"> {{ __('main.signout') }} </a>
        </li>

        <li>
          <form id="logout_form" action=" {{ route('logout') }} " method="post" style="display: none;">
            @csrf
          </form>
        </li>
      @endauth

      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"> {{ __('main.lang') }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href=" {{ url('lang/set/ar') }} "> ع </a></li>
          <li><a href=" {{ url('lang/set/en') }}"> en </a></li>
        </ul>
      </li>

    </ul>
  @endif

</nav>
