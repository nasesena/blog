<!--ページャーの設定を行うViewです-->

<!--スタイルシート設定-->
<link rel="stylesheet" href="{{ asset('css/pager.css')}}">

@if ($paginator->hasPages())
    <ul class="disabled">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="disabled">
                <span class="nolmal">
                    &laquo;
                </span>
            </div>
        @else
            <div class="disabled"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></div>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="disabled"><span class="nolmal">{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="disabled"><span class="nolmal">{{ $page }}</span></div>
                    @else
                        <div class="disabled"><a href="{{ $url }}">{{ $page }}</a></div>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="disabled"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></div>
        @else
            <div class="disabled"><span class="nolmal">&raquo;</span></div>
        @endif
    </ul>
@endif
