<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderByRaw('COALESCE(jadwal_tayang, created_at) DESC')->get();
        return view('admin.berita', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'kategori'      => 'required|string|max:100',
            'isi'           => 'required|string',
            'status'        => 'required|in:terbit,draf',
            'jadwal_tayang' => 'nullable|date',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('berita', 'public');
        }

        // Jika status 'terbit' & jadwal dikosongkan, otomatis isi waktu sekarang
        $jadwal = $request->jadwal_tayang
            ? Carbon::parse($request->jadwal_tayang)
            : ($request->status === 'terbit' ? now() : null);

        Berita::create([
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul) . '-' . time(),
            'kategori'      => $request->kategori,
            'isi'           => $request->isi,
            'gambar'        => $pathGambar,
            'status'        => $request->status,
            'jadwal_tayang' => $jadwal,
        ]);

        if ($request->status === 'draf') {
            $pesan = 'Berita berhasil disimpan sebagai draf!';
        } elseif ($jadwal && $jadwal->isFuture()) {
            $pesan = 'Berita berhasil dijadwalkan tayang pada ' . $jadwal->format('d M Y, H:i') . ' WIB!';
        } else {
            $pesan = 'Berita berhasil diterbitkan!';
        }

        return back()->with('sukses', $pesan);
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'kategori'      => 'required|string|max:100',
            'isi'           => 'required|string',
            'status'        => 'required|in:terbit,draf',
            'jadwal_tayang' => 'nullable|date',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathGambar = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $pathGambar = $request->file('gambar')->store('berita', 'public');
        }

        $jadwal = $request->jadwal_tayang
            ? Carbon::parse($request->jadwal_tayang)
            : ($request->status === 'terbit' ? ($berita->jadwal_tayang ?? now()) : null);

        $berita->update([
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul) . '-' . $berita->id,
            'kategori'      => $request->kategori,
            'isi'           => $request->isi,
            'gambar'        => $pathGambar,
            'status'        => $request->status,
            'jadwal_tayang' => $jadwal,
        ]);

        return back()->with('sukses', 'Berita berhasil diperbarui!');
    }

    public function show($slug)
    {
        $berita = Berita::tayang()
            ->where('slug', $slug)
            ->firstOrFail();

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