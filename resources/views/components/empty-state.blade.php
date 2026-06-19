@props([
    'icon' => null,
    'title' => 'Tidak ada data',
    'description' => 'Kami tidak dapat menemukan apa yang Anda cari saat ini.',
    'actionUrl' => null,
    'actionText' => null,
])

<div class="flex flex-col items-center justify-center py-16 px-4 text-center rounded-2xl bg-surface-white border border-outline border-dashed">
    <div class="w-20 h-20 mb-6 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant">
        @if($icon)
            {{ $icon }}
        @else
            <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        @endif
    </div>
    
    <h3 class="text-title-md font-display font-bold text-text-primary mb-2">{{ $title }}</h3>
    <p class="text-body-md text-on-surface-variant max-w-sm mb-8">{{ $description }}</p>
    
    @if($actionUrl && $actionText)
    <a href="{{ $actionUrl }}" class="inline-flex items-center px-6 py-3 bg-primary text-white text-label-md font-semibold rounded-full hover:bg-primary-dark hover:-translate-y-0.5 transition-all duration-300 shadow-sm hover:shadow-md">
        {{ $actionText }}
    </a>
    @endif
    
    {{ $slot }}
</div>
