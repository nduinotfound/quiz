@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-6 rounded-lg">
                <div class="flex items-center">
                    <div class="text-blue-500 text-3xl mr-4">📰</div>
                    <div>
                        <div class="text-2xl font-bold text-blue-600">{{ $totalBerita }}</div>
                        <div class="text-blue-500">Total Berita</div>
                    </div>
                </div>
            </div>

            <div class="bg-green-100 p-6 rounded-lg">
                <div class="flex items-center">
                    <div class="text-green-500 text-3xl mr-4">👥</div>
                    <div>
                        <div class="text-2xl font-bold text-green-600">{{ $totalUser }}</div>
                        <div class="text-green-500">Total User</div>
                    </div>
                </div>
            </div>

            <div class="bg-purple-100 p-6 rounded-lg">
                <div class="flex items-center">
                    <div class="text-purple-500 text-3xl mr-4">⚡</div>
                    <div>
                        <div class="text-2xl font-bold text-purple-600">{{ $beritaTerbaru->count() }}</div>
                        <div class="text-purple-500">Berita Terbaru</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Berita Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Judul</th>
                            <th class="px-4 py-2 text-left">Penulis</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritaTerbaru as $berita)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ Str::limit($berita->judul, 50) }}</td>
                            <td class="px-4 py-2">{{ $berita->penulis }}</td>
                            <td class="px-4 py-2">{{ $berita->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('berita.show', $berita) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
