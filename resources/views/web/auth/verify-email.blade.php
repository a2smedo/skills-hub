
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
            <li> Verify Email </li>
          </ul>
          {{-- <h1 class="white-text">{{__('main.signinDesc')}} </h1> --}}



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
            <p class="">
                You must verify your email address, please check your email for verification link.
             </p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route("verification.send") }} ">
              @csrf

              <input type="submit" class="main-button icon-button about-img
                @if(App::getLocale() == "en") pull-right @else pull-left @endIf"
                 value="Resend email">
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
