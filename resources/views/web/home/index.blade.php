@extends('web.layout')

@section('title')
  {{ __('main.home') }}
@endsection

@section('main')
  <!-- Home -->
  <div id="home" class="hero-area">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/home-background.jpg') }})">
    </div>
    <!-- /Backgound Image -->

    <div class="home-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1 class="white-text"> {{ __('main.heroTitle') }} </h1>
            <p class="lead white-text"> {{ __('main.heroDesc') }} </p>


            {{-- <a class="main-button icon-button"
              href=" {{ route('login') }} ">{{ __('main.startedBtn') }} </a> --}}



          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /Home -->

  <!-- Courses -->
  <div id="courses" class="section">

    <!-- container -->
    <div class="container">

      <!-- row -->
      <div class="row">
        <div class="section-header text-center">
          <h2> {{ __('main.popularExamTitle') }} </h2>
          <p class="lead">{{ __('main.popularExamDesc') }}</p>
        </div>
      </div>
      <!-- /row -->

      <!-- courses -->
      <div id="courses-wrapper ">
        @csrf
        <div class="row" id="moreData"></div>

      </div>
      <!-- container -->

    </div>
    <!-- /Courses -->


    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

      <!-- Backgound Image -->
      <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/cta.jpg') }} )"></div>
      <!-- Backgound Image -->

      <!-- container -->
      <div class="container">

        <!-- row -->
        <div class="row">

          <div class="col-md-8 col-md-offset-2 text-center">
            <h2 class="white-text"> {{ __('main.contact') }} </h2>
            <p class="lead white-text"> {{ __('main.contactDesc') }} </p>
            <a class="main-button icon-button" href="{{ url('contact-us') }}"> {{ __('main.contactBtn') }} </a>
          </div>

        </div>
        <!-- /row -->

      </div>
      <!-- /container -->

    </div>
    <!-- /Contact CTA -->
  @endsection



  @section('cScript')

    <script>
      $(document).ready(function() {

        var token = $('input[name="_token"]').val();

        loadMore('', token);


        $('body').on('click', '#loadBtn', function() {

          $('#loadBtn').html("{{ __('main.loadingBtn') }}");

          setTimeout(() => {
            var id = $(this).data('id');
            loadMore(id, token);
          }, 1000);

        });

        function loadMore(id = "", token) {
          $.ajax({
            type: "POST",
            url: "{{ url('/load_more') }}",
            data: {
              id: id,
              _token: token
            },

            success: function(data) {
              $('#loadBtn').remove();
              $('#moreData').append(data);

            }
          });

        }
      });

    </script>

  @endsection
