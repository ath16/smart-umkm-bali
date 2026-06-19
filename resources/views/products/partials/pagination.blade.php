@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        <div class="hidden sm:flex sm:items-center sm:gap-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant/40 cursor-not-allowed">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                    Sebelumnya
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="inline-flex items-center justify-center w-9 h-9 text-body-sm text-on-surface-variant">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-heritage bg-primary text-white text-body-sm font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-heritage text-body-sm text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">
                    Berikutnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </a>
            @else
                <span class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant/40 cursor-not-allowed">
                    Berikutnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </span>
            @endif
        </div>

        {{-- Mobile pagination --}}
        <div class="flex sm:hidden items-center justify-between w-full">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant/40 cursor-not-allowed">Sebelumnya</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-primary font-medium hover:bg-cream transition-colors">Sebelumnya</a>
            @endif

            <span class="text-body-sm text-on-surface-variant">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-primary font-medium hover:bg-cream transition-colors">Berikutnya</a>
            @else
                <span class="inline-flex items-center px-3 py-2 rounded-heritage text-body-sm text-on-surface-variant/40 cursor-not-allowed">Berikutnya</span>
            @endif
        </div>
    </nav>
@endif
