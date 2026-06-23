@extends('layouts.public')

@section('title', 'Kisah & Artikel')

@section('meta')
    <meta property="og:title" content="Kisah & Artikel - Smart UMKM Bali" />
    <meta property="og:description" content="Temukan cerita di balik karya luar biasa para pengrajin lokal dan tips pengembangan bisnis." />
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-surface-container py-16 md:py-24 border-b border-outline">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-display-sm md:text-display-md font-display font-bold text-text-primary mb-6">
            Cerita di Balik Karya
        </h1>
        <p class="text-body-lg text-on-surface-variant max-w-2xl mx-auto">
            Jelajahi kisah inspiratif dari para pelaku UMKM, panduan pengembangan usaha, dan kurasi gaya hidup lokal Bali.
        </p>
    </div>
</div>

<!-- Blog Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
            <a href="{{ route('blog.show', $article->slug) }}" class="group flex flex-col bg-surface-white border border-outline rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <!-- Featured Image -->
                <div class="aspect-w-16 aspect-h-10 w-full overflow-hidden bg-surface-container">
                    @if($article->featured_image)
                        <img src="{{ imageUrl($article->featured_image_url, 'medium') }}" alt="{{ $article->title }}" class="w-full h-64 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-64 flex items-center justify-center text-on-surface-variant">
                            <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4 text-xs font-semibold uppercase tracking-wider text-primary">
                        <span>{{ $article->category->name ?? 'Cerita' }}</span>
                        <span class="w-1 h-1 rounded-full bg-outline-dark"></span>
                        <span class="text-on-surface-variant">{{ $article->published_at->format('d M Y') }}</span>
                    </div>
                    
                    <h2 class="text-title-lg font-display font-bold text-text-primary mb-3 group-hover:text-primary transition-colors line-clamp-2">
                        {{ $article->title }}
                    </h2>
                    
                    <p class="text-body-md text-on-surface-variant line-clamp-3 mb-6 flex-grow">
                        {{ $article->excerpt }}
                    </p>
                    
                    <div class="flex items-center mt-auto pt-4 border-t border-outline">
                        <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary-dark font-bold text-xs mr-3">
                            {{ substr($article->author->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="text-label-sm font-medium text-text-primary">
                            {{ $article->author->name ?? 'Admin' }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                <svg class="mx-auto h-16 w-16 text-on-surface-variant mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <h3 class="text-title-md font-bold text-text-primary mb-2">Belum ada artikel</h3>
                <p class="text-body-md text-on-surface-variant">Artikel dan cerita terbaru akan segera hadir.</p>
            </div>
        @endforelse
    </div>

    @if($articles->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
