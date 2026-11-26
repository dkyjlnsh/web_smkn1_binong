<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::orderBy('urutan')->orderBy('id')->get();
        return view('admin.jurusan', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'      => 'required|string|max:20',
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prospek'   => 'nullable|string|max:255',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'required|integer|min:1',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('jurusan', 'public');
        }

        Jurusan::create($data);

        return redirect()->route('admin.jurusan')->with('sukses', 'Kompetensi keahlian berhasil ditambahkan.');
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $data = $request->validate([
            'kode'      => 'required|string|max:20',
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prospek'   => 'nullable|string|max:255',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'required|integer|min:1',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($jurusan->gambar) {
                Storage::disk('public')->delete($jurusan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jurusan', 'public');
        }

        $jurusan->update($data);

        return redirect()->route('admin.jurusan')->with('sukses', 'Kompetensi keahlian berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        if ($jurusan->gambar) {
            Storage::disk('public')->delete($jurusan->gambar);
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan')->with('sukses', 'Kompetensi keahlian berhasil dihapus.');
    }
}