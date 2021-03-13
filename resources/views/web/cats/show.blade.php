@extends('web.layout')

@section('title')
  {{ __('main.categories') }}
@endsection

@section('main')
  <!-- Hero-area -->
  <div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
    <!-- /Backgound Image -->

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <ul class="hero-area-tree">
            <li><a href="{{ url('/') }}"> {{ __('main.home') }} </a></li>
            <li class="text-capitalize"> {{ $cat->name() }} </li>
          </ul>
          <h1 class="white-text text-uppercase">{{ $cat->name() }} </h1>

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

          <!-- row -->
          <div class="row mb-5">

            @foreach ($skills as $skill)
              <!-- single skill -->
              <div class="col-md-4 mb-3">
                <div class="single-blog">
                  <div class="blog-img">
                    <a href="{{ url("skill/$skill->id") }}">
                      <img src="{{ asset("uploads/$skill->img") }}" alt="">
                    </a>
                  </div>
                  <h4>
                    <a href="{{ url("skill/$skill->id") }}">{{ $skill->name() }} </a>
                  </h4>
                  <div class="blog-meta">
                    <span>{{ Carbon\Carbon::parse($skill->created_at)->format('d M, Y') }}</span>
                    <div class="pull-right">
                      <span class="blog-meta-comments">
                        <a href="#">
                          <i class="fa fa-users"></i>
                          {{ $skill->studentCount() }}
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /single skill -->
            @endforeach

          </div>
          <!-- /row -->

          <!-- row -->
          <div class="row">

            <!-- pagination -->

            {{ $skills->links('web.inc.paginator')}}

            <!-- pagination -->

          </div>
          <!-- /row -->
        </div>
        <!-- /main blog -->

        <!-- aside blog -->
        <div id="aside" class="col-md-3">

          <!-- search widget -->
          <div class="widget search-widget">
            <form>
              <input class="input" type="text" name="search">
              <button><i class="fa fa-search"></i></button>
            </form>
          </div>
          <!-- /search widget -->

          <!-- category widget -->
          <div class="widget category-widget">
            <h3> {{ __('main.categories') }} </h3>

            @foreach ($cats as $c)
              <a class="category" href="{{ url("category/$c->id") }}">
                {{ $c->name() }}
                <span> {{ $c->skills()->count() }} </span>
              </a>
            @endforeach

          </div>
          <!-- /category widget -->
        </div>
        <!-- /aside blog -->

      </div>
      <!-- row -->

    </div>
    <!-- container -->

  </div>
  <!-- /Blog -->

@endsection
