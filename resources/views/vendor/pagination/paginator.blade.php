@if ($paginator->hasPages())
    <nav aria-label="...">
        <ul class="pagination">
            @unless ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @endunless

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active': '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }} <span class="sr-only">(current)</span></a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
@endif
