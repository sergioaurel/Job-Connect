@if ($paginator->hasPages())
<nav class="flex flex-col sm:flex-row items-center justify-between gap-4" aria-label="Pagination">

    {{-- Compteur discret --}}
    <p class="text-xs text-gray-400 font-medium">
        <span class="text-gray-900 font-bold">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
        sur
        <span class="text-gray-900 font-bold">{{ $paginator->total() }}</span>
        offre(s)
    </p>

    {{-- Boutons de navigation --}}
    <div class="flex items-center gap-1">

        {{-- Précédent --}}
        @if ($paginator->onFirstPage())
        <span class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-300 cursor-not-allowed bg-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-600 bg-white hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)

            {{-- Séparateur "..." --}}
            @if (is_string($element))
            <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm font-bold select-none">
                ···
            </span>
            @endif

            {{-- Numéros de pages --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-900 text-white text-sm font-extrabold">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $url }}"
                       class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-600 text-sm font-bold bg-white hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Suivant --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-600 bg-white hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @else
        <span class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-300 cursor-not-allowed bg-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </span>
        @endif

    </div>
</nav>
@endif