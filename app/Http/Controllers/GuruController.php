<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('urutan', 'asc')->orderBy('nama', 'asc')->get();
        return view('admin.guru', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'nip'    => 'nullable|string|max:50',
            'mapel'  => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('guru', 'public');
        }

        Guru::create([
            'nama'   => $request->nama,
            'nip'    => $request->nip,
            'mapel'  => $request->mapel,
            'urutan' => $request->urutan ?? 1,
            'foto'   => $pathFoto,
        ]);

        return back()->with('sukses', 'Data guru berhasil ditambahkan!');
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'nip'    => 'nullable|string|max:50',
            'mapel'  => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'nama'   => $request->nama,
            'nip'    => $request->nip,
            'mapel'  => $request->mapel,
            'urutan' => $request->urutan ?? 1,
        ];

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return back()->with('sukses', 'Data guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return back()->with('sukses', 'Data guru berhasil dihapus!');
    }
}