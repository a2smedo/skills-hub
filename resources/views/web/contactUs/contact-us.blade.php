@extends('web.layout')
@section('title')
  {{ __('main.contact') }}
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
            <li><a href="index.html"> {{ __('main.home') }}</a></li>
            <li> {{ __('main.contact') }}</li>
          </ul>
          <h1 class="white-text"> {{ __('main.contactDesc') }} </h1>

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

        <!-- contact form -->
        <div class="col-md-6">
          <div class="contact-form">
            <h4> {{ __('main.sendMsg') }} </h4>

            {{-- method="POST" action=" {{ url('contact/store') }} "
            --}}
            <form id="msgForm">
              @csrf

              <input class="input" type="text" name="name" placeholder=" {{ __('main.name') }}">

              <input class="input" type="email" name="email" placeholder=" {{ __('main.email') }}">

              <input class="input" type="text" name="subject" placeholder=" {{ __('main.subject') }}">

              <textarea class="input" name="body" placeholder=" {{ __('main.messageBody') }} "></textarea>
              <button class="main-button icon-button pull-right"> {{ __('main.sendBtn') }}</button>
            </form>


          </div>
          <div class="alert mt-5 d-none" id="msg" role="alert"></div>

        </div>
        <!-- /contact form -->

        <!-- contact information -->
        <div class="col-md-5 col-md-offset-1">
          <h4> {{ __('main.contactInfo') }} </h4>
          <ul class="contact-details">
            <li><i class="fa fa-envelope"></i> {{ $setting->email }} </li>
            <li><i class="fa fa-phone"></i> {{ $setting->phone }} </li>
          </ul>

        </div>
        <!-- contact information -->

      </div>
      <!-- /row -->

    </div>
    <!-- /container -->

  </div>
  <!-- /Contact -->

@endsection


@section('cScript')

  <script>

    $('#msgForm').submit(function(e) {
      e.preventDefault();
      $('#msg').empty();

      let data = new FormData($('#msgForm')[0]);


      $.ajax({
        type: "POST",
        url: "{{ url('contact/send') }}",
        data: data,
        contentType: false,
        processData: false,
        success: function(data) {
          $('#msg').addClass('alert-success');
          $('#msg').text(data.msg);
        },
        error: function(xhr, status, error) {

          $.each(xhr.responseJSON.errors, function(key, item) {
            $('#msg').addClass('alert-danger');
            $('#msg').append("<p>" + item[0] + "</p>");
          });
        }
      });

     setInterval(() => {
        $('#msg').empty();
        $('.input').val('');
        $('#msg').removeClass('alert-success');
        $('#msg').removeClass('alert-danger');

      }, 5000);







    });

  </script>

@endsection
