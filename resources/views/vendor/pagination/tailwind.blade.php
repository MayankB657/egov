@if ($paginator->hasPages())
    <nav>
        <ul class="pagination pagination-circle pagination-outline">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item previous m-1 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="page-link"><i class="previous"></i></span>
                </li>
            @else
                <li class="page-item previous m-1">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')"><i class="previous"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item m-1 disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item m-1 active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item m-1">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item next m-1">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">
                        <i class="next"></i>
                    </a>
                </li>
            @else
                <li class="page-item next m-1 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true" class="page-link"><i class="next"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
