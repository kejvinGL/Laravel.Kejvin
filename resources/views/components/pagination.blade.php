@if ($paginator->hasPages())
    <div class="join">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="join-item btn btn-disabled">
                            {!! __('<<') !!}
                        </span>
                    @else
                        <a class="join-item btn" href="{{$paginator->url(1)}}">
                            {!! __('<<') !!}
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="join-item btn btn-disabled">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="join-item btn btn-active">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="join-item btn"
                                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->url($paginator->lastPage())}}" rel="next"
                           class='join-item btn'
                           aria-label="{{ __('pagination.next') }}">
                            >>
                        </a>
                    @else
                        <span rel="next"
                            class='join-item btn btn-disabled'
                            aria-label="{{ __('pagination.next') }}">
                            >>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div>
@endif
