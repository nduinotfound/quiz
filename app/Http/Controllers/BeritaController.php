<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'admin'])->except(['index', 'show']);
        $this->middleware(['auth', 'verified'])->only(['index', 'show']);
    }

    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        return view('berita.index', compact('berita'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|min:10|max:255',
            'konten' => 'required|string|min:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.min' => 'Judul berita minimal 10 karakter.',
            'konten.required' => 'Konten berita wajib diisi.',
            'konten.min' => 'Konten berita minimal 20 karakter.',
            'foto.required' => 'Foto berita wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'penulis.required' => 'Nama penulis wajib diisi.',
        ]);

        $fotoPath = $request->file('foto')->store('berita', 'public');

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'foto' => $fotoPath,
            'penulis' => $request->penulis,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $beritum)
    {
        return view('berita.show', compact('beritum'));
    }

    public function edit(Berita $beritum)
    {
        return view('berita.edit', compact('beritum'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|min:10|max:255',
            'konten' => 'required|string|min:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.min' => 'Judul berita minimal 10 karakter.',
            'konten.required' => 'Konten berita wajib diisi.',
            'konten.min' => 'Konten berita minimal 20 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'penulis.required' => 'Nama penulis wajib diisi.',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'penulis' => $request->penulis,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($beritum->foto && Storage::disk('public')->exists($beritum->foto)) {
                Storage::disk('public')->delete($beritum->foto);
            }

            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        // Hapus foto
        if ($beritum->foto && Storage::disk('public')->exists($beritum->foto)) {
            Storage::disk('public')->delete($beritum->foto);
        }

        $beritum->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
