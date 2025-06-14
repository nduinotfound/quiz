<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Tombol Tambah Berita untuk Admin --}}
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="mb-6">
                                <a href="{{ route('berita.create') }}"
                                   class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Berita (Admin)
                                </a>
                            </div>
                        @else
                            <div class="mb-6 p-3 bg-red-100 border border-red-400 rounded text-sm">
                                ❌ Tombol tidak muncul karena role Anda: <strong>{{ auth()->user()->role ?? 'NULL' }}</strong><br>
                                Untuk melihat tombol, role harus: <strong>admin</strong>
                            </div>
                        @endif
                    @endauth

                    {{-- List Berita --}}
                    <div class="grid gap-6">
                        @forelse ($berita as $item)
                            <div class="border rounded-lg p-6 flex">
                                <div class="flex-shrink-0 mr-6">
                                    <img src="{{ Storage::url($item->foto) }}"
                                         alt="{{ $item->judul }}"
                                         class="w-32 h-24 object-cover rounded">
                                </div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-semibold mb-2">
                                        <a href="{{ route('berita.show', $item) }}"
                                           class="text-gray-900 hover:text-blue-600">
                                            {{ $item->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-2">{{ Str::limit($item->konten, 150) }}</p>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <span class="mr-4">Penulis: {{ $item->penulis }}</span>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>

                                    {{-- Aksi Admin --}}
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <div class="flex space-x-2">
                                                <a href="{{ route('berita.edit', $item) }}"
                                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('berita.destroy', $item) }}"
                                                      method="POST"
                                                      class="inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @empty
                            {{-- Jika Tidak Ada Berita --}}
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada berita yang tersedia.</p>

                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <div class="mt-4">
                                            <a href="{{ route('berita.create') }}"
                                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Tambah Berita Pertama
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @endforelse
                    </div>

                    {{-- Paginasi --}}
                    <div class="mt-6">
                        {{ $berita->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
