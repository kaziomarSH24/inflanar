<div class="inflanar-pagination">
    <ul class="inflanar-pagination__list list-none">
        @if ($paginator->onFirstPage())
        @else
            <li class="inflanar-pagination__button"><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
        @endif

        @foreach ($elements as $element)
            @if (!is_array($element))
                <li><a href="javascript:;">...</a></li>
            @else
                @if (count($element) < 2)
                @else
                    @foreach ($element as $key => $el)
                        @if ($key == $paginator->currentPage())
                            <li class="active"><a href="javascript::void()">{{ $key }}</a></li>
                        @else
                            <li><a href="{{ $el }}">{{ $key }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <li class="inflanar-pagination__button"><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
        @endif


    </ul>
</div>
