<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Berita') }}
            </h2>
            @if(auth()->user()->isAdmin())
                <div class="flex space-x-2">
                    <a href="{{ route('berita.edit', $beritum) }}"
                       class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <form action="{{ route('berita.destroy', $beritum) }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <article>
                        <header class="mb-6">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $beritum->judul }}</h1>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="mr-4">Penulis: {{ $beritum->penulis }}</span>
                                <span>{{ $beritum->created_at->format('d F Y, H:i') }}</span>
                            </div>
                        </header>

                        <div class="mb-6">
                            <img src="{{ Storage::url($beritum->foto) }}" alt="{{ $beritum->judul }}"
                                 class="w-full h-64 object-cover rounded-lg">
                        </div>

                        <div class="prose max-w-none">
                            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $beritum->konten }}</div>
                        </div>
                    </article>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('berita.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
