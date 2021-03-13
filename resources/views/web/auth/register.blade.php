@extends('web.layout')
@section('title')
  {{ __('main.signup') }}
@endsection
@section('main')

  <!-- Hero-area -->
  <div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }} )">
    </div>
    <!-- /Backgound Image -->

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <ul class="hero-area-tree">
            <li><a href=" {{ url('/') }} "> {{ __('main.home') }}</a></li>
            <li> {{ __('main.signup') }}</li>
          </ul>
          <h1 class="white-text"> {{ __('main.heroDesc') }}</h1>

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
            <h4> {{ __('main.signup') }} </h4>
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <input class="input" type="text" name="name" placeholder=" {{ __('main.name') }}" value="{{ old('name') }}">

              @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong> {{ $message }} </strong>
                </span>
              @enderror




              <input class="input" type="email" name="email" placeholder=" {{ __('main.email') }}"
                value="{{ old('email') }}">

              @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong> {{ $message }} </strong>
                </span>
              @enderror
              <input class="input" type="password" name="password" placeholder=" {{ __('main.password') }}">

              @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                  <strong> {{ $message }} </strong>
                </span>
              @enderror
              <input class="input" type="password" name="password_confirmation"
                placeholder=" {{ __('main.confPassword') }}">


            <input type="submit" class="main-button icon-button @if (App::getLocale()=='en' ) pull-right @else pull-left @endIf" value="{{ __('main.signup') }}">
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
