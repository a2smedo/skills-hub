@extends('web.layout')
@section('title')
  {{ $exam->name() }}
@endsection

@section('customCss')
  <style>
    .cancelModal {
      height: 100vh;
      background-color: rgba(14, 15, 15, 0.404);
      position: fixed;
      display: none;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 20000000;

    }

    .modalRow {
      text-align: center;
      width: 60%;
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);

    }

    .yes {
      display: inline-block;
      margin: 5px 20px;
    }

    .no {
      display: inline-block;

    }

  </style>
@endsection

@section('main')
  <!-- Hero-area -->
  <div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay"
      style="background-image:url({{ asset('web/img/blog-post-background.jpg') }})"></div>
    <!-- /Backgound Image -->

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <ul class="hero-area-tree">
            <li>
              <a href="{{ url('/') }}"> {{ __('main.home') }} </a>
            </li>
            <li>
              <a href="{{ url("category/{$exam->skill->cat->id}") }} ">
                {{ $exam->skill->cat->name() }}
              </a>
            </li>
            <li><a href=" {{ url("skill/{$exam->skill->id}") }}">
                {{ $exam->skill->name() }} </a>
            </li>


            <li> {{ $exam->name() }} </li>
          </ul>
          <h1 class="white-text">{{ $exam->name() }}</h1>
          <ul class="blog-post-meta">
            <li>{{ Carbon\Carbon::parse($exam->created_at)->format('d M, Y') }}</li>
            <li class="blog-meta-comments">
              <a href="#">
                <i class="fa fa-users"></i>
                {{ $exam->users()->count() }}
              </a>
            </li>


          </ul>
        </div>
      </div>
    </div>

  </div>
  <!-- /Hero-area -->

  <!-- Blog -->
  <div id="blog" class="section">

    <!-- container -->
    <div class="container">

      <!-- row -->
      <div class="row">

        <!-- main blog -->
        <div id="main" class="col-md-9">


          <!-- blog post -->
          <div class="blog-post mb-5">
            <p>
              @foreach ($questions as $i => $ques)

                <div class="panel panel-default">
                  <div class="panel-heading bg-danger ">
                    <h3 class="panel-title"> {{ $i + 1 }}- {{ $ques->title }} </h3>
                  </div>


                  <form action=" {{ url("exam/send/{$exam->id}") }} " method="post" id="form">
                    @csrf

                    <div class="panel-body mt-2">

                      <div class="radio">
                        <label>
                          <input type="radio" name="ans[{{ $ques->id }}]" value="1" form="form">
                          {{ $ques->option_1 }}
                        </label>
                      </div>

                      <div class="radio">
                        <label>
                          <input type="radio" name="ans[{{ $ques->id }}]" value="2" form="form">
                          {{ $ques->option_2 }}
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="ans[{{ $ques->id }}]" value="3" form="form">
                          {{ $ques->option_3 }}
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="ans[{{ $ques->id }}]" value="4" form="form">
                          {{ $ques->option_1 }}
                        </label>
                      </div>
                    </div>
                  </form>

                </div>
              @endforeach

            <div>
              <button type="submit" form="form" class="main-button icon-button"> {{ __('main.submitBtn') }}
              </button>


              <button id="cancelExam" type="button" data-id="{{ $exam->id }}"
                class="main-button icon-button btn-danger ml-sm">
                {{ __('main.cancelBtn') }}
              </button>

            </div>
            </p>
          </div>
          <!-- /blog post -->




        </div>
        <!-- /main blog -->

        <!-- aside blog -->
        <div id="aside" class="col-md-3">

          <!-- exam details widget -->
          <ul class="list-group">
            <li class="list-group-item">
              {{ __('main.skill') }} : {{ $exam->skill->name() }}
            </li>
            <li class="list-group-item">
              {{ __('main.questions') }}: {{ $exam->questions_no }}
            </li>
            <li class="list-group-item">
              {{ __('main.duration') }} : {{ $exam->duration_mins }} {{ __('main.min') }}
            </li>
            <li class="list-group-item">
              {{ __('main.difficulty') }} :

              @for ($i = 1; $i <= $exam->difficulty; $i++)
                <i class="fa fa-star"></i>
              @endfor

              @for ($i = 1; $i <= 5 - $exam->difficulty; $i++)
                <i class="fa fa-star-o"></i>
              @endfor

            </li>

            <li class="list-group-item" id="timer"></li>
          </ul>
          <!-- /exam details widget -->


        </div>
        <!-- /aside blog -->

      </div>
      <!-- row -->

    </div>
    <!-- container -->

  </div>

  <!-- /Blog -->




@endsection

@section('modal')
  <section class="cancelModal">
    <div class="container">

      <div class="row modalRow">
        <div class="col-md">
          <div class="jumbotron ">
            <h2>Are you sure to cancel this Exam you lost score and you don't replay this exam agin ? </h2>

            <div class="yes">
              <form action="{{ url("exam/cancel/$exam->id") }}" method="post">
                @csrf
                <input type="hidden" name="exam_id" id="exam_id">
                <input type="submit" class="btn btn-lg btn-danger" id="yes" value="Yes">
              </form>
            </div>

            <div class="no">
              <button id="no" class="btn btn-lg  btn-info">No</button>
            </div>


          </div>
        </div>
      </div>


    </div>
  </section>

@endsection


@section('cScript')

  <script>
    var duration_mins = "{{ $exam->duration_mins }} ";
    var time = duration_mins * 60;
    var timer = $('#timer')
    var x = setInterval(count, 500);

    function count() {
      var min = Math.floor(time / 60);
      var sec = time % 60;

      timer.html(`Time : ${min} : ${sec}`);
      time--;

      if (time === 0) {
        sec = 0;
        $("#form").submit();
        clearInterval(x);
        return;
      }
    }


    $("#cancelExam").click(function(e) {
      e.preventDefault();
      $('.cancelModal').css("display", "block");

      var exam_id = $(this).attr("data-id");

      $("#yes").click(function() {
        let x = $("#exam_id").val(exam_id);
      });

      $("#no").click(function(e) {
        e.preventDefault();
        $('.cancelModal').css("display", "none");
      });
    });




  </script>

@endsection
