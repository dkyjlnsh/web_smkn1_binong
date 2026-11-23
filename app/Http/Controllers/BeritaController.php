<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            $pathGambar =$request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul'    => $request->judul,
            'slug'     => Str::slug($request->judul) . '-' . time(),
            'kategori' => $request->kategori,
            'isi'      => $request->isi,
            'gambar'   => $pathGambar,
        ]);

        return back()->with('sukses', 'Berita berhasil diterbitkan!');
    }

    public function update(Request $request, Berita$berita)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathGambar =$berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $pathGambar =$request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul'    => $request->judul,
            'slug'     => Str::slug($request->judul) . '-' .$berita->id,
            'kategori' => $request->kategori,
            'isi'      => $request->isi,
            'gambar'   => $pathGambar,
        ]);

        return back()->with('sukses', 'Berita berhasil diperbarui!');
    }

    public function show($slug)
    {
        $berita = Berita::where('slug',$slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return back()->with('sukses', 'Berita berhasil dihapus!');
    }
}