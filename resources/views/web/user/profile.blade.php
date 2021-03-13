@extends('web.layout')
@section('title')
  Profile
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
            <li> profile </li>
          </ul>
          <h1 class="white-text"> Your Profile </h1>

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
      <div class="row py-5 mb-5">

        <!-- contact form -->
        <div class="col-md-3 mb-5">
          <div class="contact-form">
            <h4> Profile Info </h4>
            <ul class="contact-details">
              <li><i class="fa fa-user"></i>  {{Auth::user()->name }} </li>
              <li><i class="fa fa-envelope"></i>  {{Auth::user()->email }}  </li>
            </ul>
          </div>


        </div>
        <!-- /contact form -->

        <!-- contact information -->
        <div class="col-md-8 col-md-offset-1">
          <h4> Score </h4>

          <table class="table table-light">
              <thead class="thead-dark">
                  <tr>
                      <th>Exam Name</th>
                      <th>Score</th>
                      <th>Time</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($exams as $exam)
                  <tr>
                      <td> {{$exam->name()}} </td>
                      <td> {{$exam->pivot->score}} % </td>
                      <td> {{$exam->pivot->time_mins}} Mints </td>
                  </tr>
                  @endforeach
              </tbody>

          </table>

        </div>
        <!-- contact information -->

      </div>
      <!-- /row -->

    </div>
    <!-- /container -->

  </div>
  <!-- /Contact -->


@endsection
