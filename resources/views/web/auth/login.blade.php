@extends('web.layout')
@section('title')
  {{__('main.signin')}}
@endsection

@section('main')
  <!-- Hero-area -->
  <div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url( {{ asset('web/img/page-background.jpg') }} )">
    </div>
    <!-- /Backgound Image -->

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <ul class="hero-area-tree">
            <li><a href=" {{ url('/') }} ">{{__('main.home')}} </a></li>
            <li> {{__('main.signin')}}</li>
          </ul>
          <h2 class="white-text">
              {{__('main.signinDesc')}}

              <a class="sign-up" href="{{ route('register') }}">  {{__('main.signup')}}  </a>

            </h2>

        </div>
      </div>
    </div>

  </div>
  <!-- /Hero-area -->

  <!-- Contact -->
  <div id="contact" class="section">

    <!-- container -->
    <div class="container">

      <!-- row -->
      <div class="row">

        <!-- login form -->
        <div class="col-md-6 col-md-offset-3">
          <div class="contact-form">
            <h4> {{__('main.signin')}}   </h4>
            <form method="POST" action="{{ url('login') }} ">
              @csrf

              <input class="input" type="email" name="email" placeholder="{{__('main.email')}}"   >

              @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong> {{ $message }} </strong>
                </span>
              @enderror

              <input class="input" type="password" name="password" placeholder="{{__('main.password')}}">
              @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong> {{ $message }} </strong>
                </span>
              @enderror

              <div>

                <div class="form-check">

                  <label class="form-check-label" for="remember_token">
                    {{ __('main.rememberMe') }}
                  </label>
                  {{-- <input type="hidden" name="token" value="{{$request->route('token') }} "> --}}
                  <input class="form-check-input" type="checkbox" name="remember_me" id="remember_token" >

                </div>
              </div>

              <a class="text-primary" href=" {{ url('forgot-password') }} ">
                {{ __('main.forgotPassword') }}</a>

              <input type="submit" class="main-button icon-button about-img
                @if(App::getLocale() == "en") pull-right @else pull-left @endIf" value="{{ __('main.signin') }}">
            </form>
          </div>
        </div>
        <!-- /login form -->

      </div>
      <!-- /row -->

    </div>
    <!-- /container -->

  </div>
  <!-- /Contact -->
@endsection
