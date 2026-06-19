<x-admin-layout>
    <x-slot name="title">Manajemen Artikel</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-title-lg font-display font-bold text-text-primary">Manajemen Artikel</h1>
        <p class="text-body-sm text-on-surface-variant mt-1">Kelola publikasi blog, spotlight UMKM, dan konten editorial.</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-label-md font-semibold rounded-full hover:bg-primary-dark transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tulis Artikel
    </a>
</div>

<div class="bg-surface-white border border-outline rounded-2xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container/50 border-b border-outline">
                    <th class="px-6 py-4 text-label-sm font-semibold text-text-primary">Judul</th>
                    <th class="px-6 py-4 text-label-sm font-semibold text-text-primary">Kategori</th>
                    <th class="px-6 py-4 text-label-sm font-semibold text-text-primary">Status</th>
                    <th class="px-6 py-4 text-label-sm font-semibold text-text-primary">Tanggal</th>
                    <th class="px-6 py-4 text-label-sm font-semibold text-text-primary text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline">
                @forelse($articles as $article)
                <tr class="hover:bg-surface-container/30 transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-body-md font-medium text-text-primary">{{ $article->title }}</p>
                        <p class="text-body-sm text-on-surface-variant line-clamp-1">{{ $article->excerpt }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-container text-on-surface-variant">
                            {{ $article->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($article->status === 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success/10 text-success">Published</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-container text-on-surface-variant">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-body-sm text-on-surface-variant">
                        {{ $article->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant text-body-md">
                        Belum ada artikel.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($articles->hasPages())
    <div class="px-6 py-4 border-t border-outline">
        {{ $articles->links() }}
    </div>
    @endif
</div>
</x-admin-layout>
