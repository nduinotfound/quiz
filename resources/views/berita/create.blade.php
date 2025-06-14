<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror">
                            @error('judul')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
                            <textarea name="konten" id="konten" rows="8"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('konten') border-red-500 @enderror">{{ old('konten') }}</textarea>
                            @error('konten')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Berita</label>
                            <input type="file" name="foto" id="foto" accept="image/*"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('foto') border-red-500 @enderror">
                            @error('foto')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                            <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('penulis') border-red-500 @enderror">
                            @error('penulis')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('berita.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-blue font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
