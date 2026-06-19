<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Log (Riwayat Aktivitas)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-200 bg-gray-50">
                                <th class="p-3 font-semibold text-gray-700">Waktu</th>
                                <th class="p-3 font-semibold text-gray-700">User (Pelaku)</th>
                                <th class="p-3 font-semibold text-gray-700">Tipe Aksi</th>
                                <th class="p-3 font-semibold text-gray-700">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->created_at->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td class="p-3 font-medium text-gray-800">
                                        {{ $log->user->name ?? 'Unknown' }} 
                                        <span class="text-xs text-gray-500 block">{{ $log->user->role ?? '' }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full uppercase tracking-wide">
                                            {{ str_replace('_', ' ', $log->action) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700">
                                        {{ $log->description }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-500">
                                        Belum ada log aktivitas yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
