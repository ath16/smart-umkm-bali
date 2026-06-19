<x-admin-layout>
    <x-slot name="title">Tulis Artikel</x-slot>
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
        <style>
            trix-editor {
                min-height: 400px;
                background-color: white;
            }
            trix-toolbar [data-trix-button-group="file-tools"] {
                display: none;
            }
        </style>
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
    <h1 class="text-title-lg font-display font-bold text-text-primary">Tulis Artikel Baru</h1>
    <a href="{{ route('admin.articles.index') }}" class="text-primary hover:underline font-medium text-body-sm">
        &larr; Kembali
    </a>
</div>

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-surface-white border border-outline rounded-2xl p-6 md:p-8 shadow-sm">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Editor Column -->
        <div class="col-span-1 lg:col-span-2 space-y-6">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-label-md font-semibold text-text-primary mb-2">Judul Artikel *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Mengenal Lebih Dekat Kerajinan Perak Celuk"
                       class="w-full px-4 py-3 border-outline rounded-heritage text-body-md focus:border-primary focus:ring focus:ring-primary/20">
                @error('title') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-label-md font-semibold text-text-primary mb-2">Kutipan (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" rows="3" placeholder="Ringkasan singkat artikel yang akan tampil di halaman depan..."
                          class="w-full px-4 py-3 border-outline rounded-heritage text-body-md focus:border-primary focus:ring focus:ring-primary/20">{{ old('excerpt') }}</textarea>
                @error('excerpt') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Content (Trix Editor) -->
            <div>
                <label for="content" class="block text-label-md font-semibold text-text-primary mb-2">Konten Artikel *</label>
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="content" class="trix-content rounded-heritage border-outline focus:border-primary focus:ring focus:ring-primary/20"></trix-editor>
                @error('content') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Sidebar / Meta Column -->
        <div class="space-y-6">
            <!-- Status & Kategori -->
            <div class="bg-surface-container/30 p-6 rounded-xl border border-outline">
                <h3 class="text-label-lg font-bold text-text-primary mb-4">Pengaturan Publikasi</h3>
                
                <div class="mb-4">
                    <label for="status" class="block text-label-sm font-semibold text-text-primary mb-2">Status</label>
                    <select id="status" name="status" class="w-full border-outline rounded-heritage text-body-sm focus:border-primary focus:ring focus:ring-primary/20">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div>
                    <label for="article_category_id" class="block text-label-sm font-semibold text-text-primary mb-2">Kategori</label>
                    <select id="article_category_id" name="article_category_id" class="w-full border-outline rounded-heritage text-body-sm focus:border-primary focus:ring focus:ring-primary/20">
                        <option value="">Pilih Kategori...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('article_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Spotlight UMKM -->
            <div class="bg-surface-container/30 p-6 rounded-xl border border-outline">
                <h3 class="text-label-lg font-bold text-text-primary mb-4">Spotlight Toko</h3>
                <p class="text-body-sm text-on-surface-variant mb-4">Pilih toko yang dibahas dalam artikel ini (opsional). Toko akan muncul sebagai *card* di bagian artikel.</p>
                
                <div class="h-48 overflow-y-auto border border-outline rounded-md p-2 bg-white">
                    @foreach($stores as $store)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="store_{{ $store->id }}" name="stores[]" value="{{ $store->id }}" 
                                   {{ is_array(old('stores')) && in_array($store->id, old('stores')) ? 'checked' : '' }}
                                   class="rounded text-primary focus:ring-primary mr-2">
                            <label for="store_{{ $store->id }}" class="text-body-sm text-text-primary">{{ $store->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-surface-container/30 p-6 rounded-xl border border-outline">
                <h3 class="text-label-lg font-bold text-text-primary mb-4">Gambar Utama</h3>
                <input type="file" name="featured_image" accept="image/*" class="w-full text-body-sm text-text-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                @error('featured_image') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- SEO Settings -->
            <div class="bg-surface-container/30 p-6 rounded-xl border border-outline">
                <h3 class="text-label-lg font-bold text-text-primary mb-4">Pengaturan SEO</h3>
                
                <div class="mb-4">
                    <label for="meta_title" class="block text-label-sm font-semibold text-text-primary mb-2">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="Opsional, default menggunakan judul"
                           class="w-full px-3 py-2 border-outline rounded-heritage text-body-sm focus:border-primary focus:ring focus:ring-primary/20">
                </div>

                <div>
                    <label for="meta_description" class="block text-label-sm font-semibold text-text-primary mb-2">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="2" placeholder="Opsional, default menggunakan kutipan"
                              class="w-full px-3 py-2 border-outline rounded-heritage text-body-sm focus:border-primary focus:ring focus:ring-primary/20">{{ old('meta_description') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-full font-semibold text-label-md hover:bg-primary-dark transition-colors shadow-sm">
            Simpan & Publikasikan
        </button>
    </div>
</form>
</x-admin-layout>
