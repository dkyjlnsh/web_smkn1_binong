<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\KuisOpsi;
use App\Models\KuisSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    public function index()
    {
        $soals = KuisSoal::with(['opsis.jurusan'])
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $jurusans = Jurusan::orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.kuis', compact('soals', 'jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan'          => 'required|string|max:255',
            'urutan'              => 'nullable|integer|min:1',
            'opsi_teks'           => 'required|array|min:2',
            'opsi_teks.*'         => 'required|string|max:255',
            'opsi_jurusan_id'     => 'required|array|min:2',
            'opsi_jurusan_id.*'   => 'required|exists:jurusans,id',
            'opsi_bobot'          => 'nullable|array',
            'opsi_bobot.*'        => 'nullable|integer|min:1|max:10',
        ]);

        DB::transaction(function () use ($validated) {
            $urutan = $validated['urutan'] ?? ((KuisSoal::max('urutan') ?? 0) + 1);

            $soal = KuisSoal::create([
                'pertanyaan' => $validated['pertanyaan'],
                'urutan'     => $urutan,
            ]);

            foreach ($validated['opsi_teks'] as $index => $teks) {
                $jurusanId = $validated['opsi_jurusan_id'][$index] ?? null;
                if ($jurusanId) {
                    KuisOpsi::create([
                        'kuis_soal_id' => $soal->id,
                        'jurusan_id'   => $jurusanId,
                        'teks_opsi'    => $teks,
                        'bobot'        => $validated['opsi_bobot'][$index] ?? 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.kuis')->with('sukses', 'Soal kuis dan pilihan jawaban berhasil ditambahkan.');
    }

    public function update(Request $request, KuisSoal $kuis)
    {
        $validated = $request->validate([
            'pertanyaan'          => 'required|string|max:255',
            'urutan'              => 'nullable|integer|min:1',
            'opsi_teks'           => 'required|array|min:2',
            'opsi_teks.*'         => 'required|string|max:255',
            'opsi_jurusan_id'     => 'required|array|min:2',
            'opsi_jurusan_id.*'   => 'required|exists:jurusans,id',
            'opsi_bobot'          => 'nullable|array',
            'opsi_bobot.*'        => 'nullable|integer|min:1|max:10',
        ]);

        DB::transaction(function () use ($validated, $kuis) {
            $kuis->update([
                'pertanyaan' => $validated['pertanyaan'],
                'urutan'     => $validated['urutan'] ?? $kuis->urutan,
            ]);

            // Ganti opsi lama dengan daftar opsi terbaru agar tambah/hapus opsi saat edit tetap sinkron
            $kuis->opsis()->delete();

            foreach ($validated['opsi_teks'] as $index => $teks) {
                $jurusanId = $validated['opsi_jurusan_id'][$index] ?? null;
                if ($jurusanId) {
                    KuisOpsi::create([
                        'kuis_soal_id' => $kuis->id,
                        'jurusan_id'   => $jurusanId,
                        'teks_opsi'    => $teks,
                        'bobot'        => $validated['opsi_bobot'][$index] ?? 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.kuis')->with('sukses', 'Soal kuis berhasil diperbarui.');
    }

    public function destroy(KuisSoal $kuis)
    {
        $kuis->delete();

        return redirect()->route('admin.kuis')->with('sukses', 'Soal kuis berhasil dihapus.');
    }
}