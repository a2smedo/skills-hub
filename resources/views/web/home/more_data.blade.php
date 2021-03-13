@if (!$exams->isEmpty())


  @foreach ($exams as $exam)

    @php($i = 0)
      <!-- single course -->
      <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="course">
          <a href=" {{ url("exam/$exam->id") }} " class="course-img">
            <img src="{{ asset("uploads/$exam->img") }}" alt="">
            <i class="course-link-icon fa fa-link"></i>
          </a>
          <a class="course-title" href="{{ url("exam/$exam->id") }}"> {{ $exam->name() }} </a>
          <div class="course-details mb-5">
            <span class="course-category"> {{ $exam->skill->cat->name() }} </span>
          </div>
        </div>
      </div>
      <!-- /single course -->
      @php($lastId = $exam->id)
        @php($i++)


        @endforeach


        <div class="col-md-12 text-center" style="padding: 20px 0;">

          <button id="loadBtn" class="main-button" data-id="{{ $lastId }}">
            {{ __('main.moreExamsBtn') }}
          </button>
        </div>


      @else

        <div class="col-md-12 text-center  mt-5">
          <h2 class="text-muted"> No More data</h2>
        </div>

      @endif
