<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = VisiMisi::where('jenis', 'visi')->first();
        $misis = VisiMisi::where('jenis', 'misi')->orderBy('urutan')->orderBy('id')->get();

        return view('admin.visimisi', compact('visi', 'misis'));
    }

    public function updateVisi(Request $request)
    {
        $request->validate(['isi' => 'required|string']);

        VisiMisi::updateOrCreate(
            ['jenis' => 'visi'],
            ['isi' => $request->isi, 'urutan' => 1]
        );

        return back()->with('sukses', 'Visi sekolah berhasil diperbarui!');
    }

    public function storeMisi(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'urutan' => 'nullable|integer|min:1',
        ]);

        $urutan = $request->urutan ?? (VisiMisi::where('jenis', 'misi')->max('urutan') + 1);

        VisiMisi::create([
            'jenis' => 'misi',
            'isi' => $request->isi,
            'urutan' => $urutan,
        ]);

        return back()->with('sukses', 'Poin misi baru berhasil ditambahkan!');
    }

    public function updateMisi(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
            'urutan' => 'required|integer|min:1',
        ]);

        $misi = VisiMisi::where('jenis', 'misi')->findOrFail($id);
        $misi->update([
            'isi' => $request->isi,
            'urutan' => $request->urutan,
        ]);

        return back()->with('sukses', 'Poin misi berhasil diperbarui!');
    }

    public function destroyMisi($id)
    {
        $misi = VisiMisi::where('jenis', 'misi')->findOrFail($id);
        $misi->delete();

        return back()->with('sukses', 'Poin misi berhasil dihapus!');
    }
}