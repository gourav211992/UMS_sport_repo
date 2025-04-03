<div class="pagination_rounded pr-4">
    <ul>

    @if (!$paginator->onFirstPage())
        <li><a href="{{ $paginator->previousPageUrl() }}" class="prev"> <i class="fa fa-chevron-left"></i> </a></li>
    @else
        <li><a href="#" class="prev"> <i class="fa fa-chevron-left"></i> </a></li>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li><a href="#" class="active">{{ $page }}</a> </li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" class="prev next"> <i class="fa fa-chevron-left"></i></a></li>
    @else
        <li><a href="#" class="prev next"> <i class="fa fa-chevron-left"></i></a></li>
    @endif
    </ul>
</div>