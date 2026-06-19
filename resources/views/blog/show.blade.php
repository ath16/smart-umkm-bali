@extends('layouts.public')

@section('title', $article->meta_title ?? $article->title)

@section('meta')
    <meta name="description" content="{{ $article->meta_description ?? $article->excerpt }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $article->meta_title ?? $article->title }}" />
    <meta property="og:description" content="{{ $article->meta_description ?? $article->excerpt }}" />
    @if($article->featured_image)
    <meta property="og:image" content="{{ asset(Storage::url($article->featured_image)) }}" />
    @endif
    <meta property="og:url" content="{{ request()->url() }}" />
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $article->meta_title ?? $article->title }}">
    <meta name="twitter:description" content="{{ $article->meta_description ?? $article->excerpt }}">
    @if($article->featured_image)
    <meta name="twitter:image" content="{{ asset(Storage::url($article->featured_image)) }}">
    @endif

    <style>
        .prose img {
            border-radius: 1rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .prose h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.875rem;
            margin-top: 3rem;
            margin-bottom: 1rem;
            color: #111827;
        }
        .prose p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: #374151;
            font-size: 1.125rem;
        }
        .prose blockquote {
            border-left-width: 4px;
            border-left-color: #fca311;
            padding-left: 1.5rem;
            font-style: italic;
            font-size: 1.25rem;
            color: #4b5563;
            margin: 2rem 0;
        }
        .prose strong {
            color: #111827;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
<article class="bg-surface pb-16">
    <!-- Header -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 text-center">
        <div class="flex items-center justify-center gap-3 mb-6 text-sm font-semibold uppercase tracking-wider text-primary">
            <span>{{ $article->category->name ?? 'Cerita' }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-outline-dark"></span>
            <span class="text-on-surface-variant">{{ $article->published_at->format('d M Y') }}</span>
        </div>
        
        <h1 class="text-display-md md:text-display-lg font-display font-bold text-text-primary mb-6 leading-tight">
            {{ $article->title }}
        </h1>
        
        <p class="text-title-md text-on-surface-variant max-w-2xl mx-auto mb-8 leading-relaxed">
            {{ $article->excerpt }}
        </p>
        
        <div class="flex items-center justify-center">
            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary-dark font-bold text-sm mr-3">
                {{ substr($article->author->name ?? 'A', 0, 1) }}
            </div>
            <div class="text-left">
                <p class="text-label-md font-semibold text-text-primary">{{ $article->author->name ?? 'Admin Smart UMKM' }}</p>
                <p class="text-label-sm text-on-surface-variant">Penulis</p>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($article->featured_image)
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="rounded-3xl overflow-hidden shadow-2xl">
            <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto max-h-[70vh] object-cover">
        </div>
    </div>
    @endif

    <!-- Content Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-24">
            
            <!-- Main Content -->
            <div class="w-full lg:w-2/3 prose max-w-none">
                {!! $article->content !!}
                
                <div class="mt-12 pt-8 border-t border-outline flex items-center gap-4">
                    <span class="text-label-md font-semibold text-text-primary">Bagikan:</span>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Sidebar (Spotlight UMKM) -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-28">
                    @if($article->stores->count() > 0)
                        <h3 class="text-title-md font-display font-bold text-text-primary mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            Spotlight UMKM
                        </h3>
                        
                        <div class="space-y-6">
                            @foreach($article->stores as $store)
                            <a href="{{ route('catalog.show', $store->slug) }}" class="block bg-surface-white border border-outline rounded-2xl p-5 hover:shadow-md transition-shadow group">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold text-lg">
                                        {{ substr($store->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-label-lg font-bold text-text-primary group-hover:text-primary transition-colors">{{ $store->name }}</h4>
                                        <p class="text-body-sm text-on-surface-variant">{{ $store->category ?? 'Toko UMKM' }}</p>
                                    </div>
                                </div>
                                <p class="text-body-sm text-on-surface-variant line-clamp-2 mb-4">
                                    {{ $store->description ?? 'Kunjungi toko ini untuk melihat koleksi produk terbaik mereka.' }}
                                </p>
                                <div class="inline-flex items-center text-label-sm font-semibold text-primary">
                                    Kunjungi Toko <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-surface-container/50 rounded-2xl p-6 border border-outline">
                            <h3 class="text-label-lg font-bold text-text-primary mb-2">Smart UMKM Bali</h3>
                            <p class="text-body-sm text-on-surface-variant mb-4">Mendukung pertumbuhan dan digitalisasi UMKM di seluruh Bali melalui teknologi kasir cerdas.</p>
                            <a href="{{ route('store.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-label-sm font-semibold rounded-full hover:bg-primary-dark transition-colors w-full justify-center">
                                Jelajahi Marketplace
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</article>

<!-- Rekomendasi Artikel -->
@if($relatedArticles->count() > 0)
<div class="bg-surface-container-high py-16 border-t border-outline">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-display-sm font-display font-bold text-text-primary mb-8 text-center">Cerita Menarik Lainnya</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedArticles as $related)
            <a href="{{ route('blog.show', $related->slug) }}" class="group flex flex-col bg-surface-white border border-outline rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="aspect-w-16 aspect-h-10 w-full overflow-hidden bg-surface-container">
                    @if($related->featured_image)
                        <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-48 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3 text-xs font-semibold uppercase tracking-wider text-primary">
                        <span>{{ $related->category->name ?? 'Cerita' }}</span>
                    </div>
                    <h3 class="text-title-md font-display font-bold text-text-primary mb-2 group-hover:text-primary transition-colors line-clamp-2">
                        {{ $related->title }}
                    </h3>
                    <p class="text-body-sm text-on-surface-variant line-clamp-2">
                        {{ $related->excerpt }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
