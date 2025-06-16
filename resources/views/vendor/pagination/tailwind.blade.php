@if ($paginator->hasPages())
    <nav class="flex justify-end items-center space-x-1 mt-2 pr-4" role="navigation" aria-label="Pagination Navigation">

        {{-- Botón Anterior --}}
        @if ($paginator->onFirstPage())
            <span
                class="cursor-not-allowed bg-gray-100 text-gray-300 rounded-full w-9 h-9 flex items-center justify-center">
                <i class="fas fa-chevron-left text-lg"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-300 rounded-full w-9 h-9 flex items-center justify-center transition">
                <i class="fas fa-chevron-left text-lg"></i>
            </a>
        @endif

        {{-- Números de página --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="text-gray-300 text-lg px-2">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                            class="bg-blue-500 text-gray-300 rounded-full w-9 h-9 flex items-center justify-center font-semibold shadow text-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-300 rounded-full w-9 h-9 flex items-center justify-center transition text-lg">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-300 rounded-full w-9 h-9 flex items-center justify-center transition">
                <i class="fas fa-chevron-right text-lg"></i>
            </a>
        @else
            <span
                class="cursor-not-allowed bg-gray-100 text-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                <i class="fas fa-chevron-right text-lg"></i>
            </span>
        @endif
    </nav>
@endif
