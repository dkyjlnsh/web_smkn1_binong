<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DudiController extends Controller
{
    public function index()
    {
        $dudis = Dudi::orderBy('urutan', 'asc')->orderBy('nama', 'asc')->get();
        return view('admin.dudi', compact('dudis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('dudi', 'public');
        }

        Dudi::create($data);

        return back()->with('sukses', 'Mitra DUDI baru berhasil ditambahkan!');
    }

    public function update(Request $request, Dudi $dudi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('logo')) {
            if ($dudi->logo) {
                Storage::disk('public')->delete($dudi->logo);
            }
            $data['logo'] = $request->file('logo')->store('dudi', 'public');
        }

        $dudi->update($data);

        return back()->with('sukses', 'Data mitra DUDI berhasil diperbarui!');
    }

    public function destroy(Dudi $dudi)
    {
        if ($dudi->logo) {
            Storage::disk('public')->delete($dudi->logo);
        }
        $dudi->delete();

        return back()->with('sukses', 'Mitra DUDI berhasil dihapus!');
    }
}