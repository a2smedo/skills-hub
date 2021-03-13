@if ($paginator->hasPages())

  <div class="col-md-12">
    <div class="post-pagination">

      @if ($paginator->onFirstPage())
        <a href="" class="btn disabled  @if(App::getLocale() == "en") pagination-back pull-left @else pull-right  pagination-next @endIf"> {{ __('main.back') }} </a>
      @else
        <a href=" {{ $paginator->previousPageUrl() }} " class=" @if(App::getLocale() == "en") pull-left pagination-back @else pull-right pagination-next @endIf"> {{ __('main.back') }} </a>
      @endif

      <ul class="pages">
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <li class="active"> {{ $page }} </li>
              @else
                <li><a href="{{ $url }} "> {{ $page }} </a></li>

              @endif
            @endforeach
          @endif
        @endforeach
      </ul>


      @if ($paginator->hasMorePages())
        <a href=" {{ $paginator->nextPageUrl() }} " class="
            @if(App::getLocale() == "en") pagination-next  pull-right  @else pagination-back pull-left @endIf">
            {{ __('main.next') }}
        </a>
      @else
        <a href="" class="btn disabled  @if(App::getLocale() == "en")
        pagination-next pull-right @else pagination-back   pull-left @endIf"> {{ __('main.next') }}</a>
      @endif



    </div>
  </div>


@endif
