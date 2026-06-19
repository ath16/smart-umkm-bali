<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Staff (Kasir)') }}
            </h2>
            <a href="{{ route('staff.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Kasir
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-200 bg-gray-50">
                                <th class="p-3 font-semibold text-gray-700">Nama Staff</th>
                                <th class="p-3 font-semibold text-gray-700">Email</th>
                                <th class="p-3 font-semibold text-gray-700">Tanggal Ditambahkan</th>
                                <th class="p-3 font-semibold text-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staffs as $staff)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3">{{ $staff->name }}</td>
                                    <td class="p-3">{{ $staff->email }}</td>
                                    <td class="p-3">{{ $staff->created_at->translatedFormat('d M Y') }}</td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route('staff.destroy', $staff) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kasir ini? Semua transaksi yang pernah dibuat oleh kasir ini akan tetap tersimpan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-500">
                                        Belum ada staff/kasir yang terdaftar di toko ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $staffs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
