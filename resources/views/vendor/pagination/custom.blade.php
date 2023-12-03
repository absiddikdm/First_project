  <!--pagination-->
  @if ($paginator->hasPages())
  <div class="pagination">
    <div class="pagination-area">
        <div class="pagination-list">
            <ul class="list-inline">
                @if ($paginator->onFirstPage())
                 <li class="disabled"><a><i class="las la-arrow-left"></i></a></li>
                 @else
                 <li><a href=" $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                @endif


                @foreach ($elements as $element)
                     @if (is_string($element))
                     <li class="disabled"><a href="#">{{ $element }}</a></li>
                     @endif
                     @if (is_array($element))
                @foreach ($element as $page => $url)
                             @if ($page == $paginator->currentPage())

                            <li><a href="#" class="active">{{ $page }}</a></li>
                          @else
                        <li class=""><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
                @endforeach

                @if ($paginator->hasMorePages())
                 <li><a href="{{ $paginator->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                 @else
                    <li ><a class="disabled"><i class="las la-arrow-right"></i></a></li>
                  @endif
            </ul>
        </div>
    </div>
</div>
@endif
