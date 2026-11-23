<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinans = Pimpinan::orderBy('urutan', 'asc')->get();
        return view('admin.pimpinan', compact('pimpinans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip'     => 'nullable|string|max:100',
            'urutan'  => 'required|integer|min:1',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto =$request->file('foto')->store('pimpinan', 'public');
        }

        Pimpinan::create([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'nip'     => $request->nip,
            'urutan'  => $request->urutan,
            'foto'    => $pathFoto,
        ]);

        return back()->with('sukses', 'Data pimpinan berhasil ditambahkan!');
    }

    public function update(Request $request, Pimpinan$pimpinan)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip'     => 'nullable|string|max:100',
            'urutan'  => 'required|integer|min:1',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pathFoto =$pimpinan->foto;
        if ($request->hasFile('foto')) {
            if ($pimpinan->foto) {
                Storage::disk('public')->delete($pimpinan->foto);
            }
            $pathFoto =$request->file('foto')->store('pimpinan', 'public');
        }

        $pimpinan->update([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'nip'     => $request->nip,
            'urutan'  => $request->urutan,
            'foto'    => $pathFoto,
        ]);

        return back()->with('sukses', 'Data pimpinan berhasil diperbarui!');
    }

    public function destroy(Pimpinan $pimpinan)
    {
        if ($pimpinan->foto) {
            Storage::disk('public')->delete($pimpinan->foto);
        }
        $pimpinan->delete();

        return back()->with('sukses', 'Data pimpinan berhasil dihapus!');
    }
}