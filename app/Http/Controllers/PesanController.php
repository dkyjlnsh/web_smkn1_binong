<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // Menampilkan semua pesan di halaman Admin
    public function index()
    {
        $pesans = Pesan::latest()->get();
        return view('admin.pesan', compact('pesans'));
    }

    // Menyimpan pesan dari pengunjung website
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string',
        ]);

        Pesan::create($validated);

        return redirect('/#kontak')->with('sukses', 'Pesan Anda berhasil terkirim dan tersimpan ke database!');
    }

    // Menghapus pesan di halaman Admin
    public function destroy(Pesan $pesan)
    {
        $pesan->delete();
        return redirect()->route('admin.pesan')->with('sukses', 'Pesan berhasil dihapus.');
    }
}