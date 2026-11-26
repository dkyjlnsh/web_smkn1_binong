<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\KuisOpsi;
use App\Models\KuisSoal;
use Illuminate\Database\Seeder;

class KuisJurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = Jurusan::all()->keyBy(fn ($item) => strtoupper(trim($item->kode)));

        if ($jurusans->isEmpty()) {
            return;
        }

        // Fallback ke jurusan pertama jika ada kode yang belum terdaftar di tabel jurusans
        $fallbackJurusanId = $jurusans->first()->id;

        $resolveJurusanId = function (string $kode) use ($jurusans, $fallbackJurusanId): int {
            $kodeUpper = strtoupper(trim($kode));
            return $jurusans[$kodeUpper]->id ?? $fallbackJurusanId;
        };

        $dataKuis = [
            [
                'pertanyaan' => 'Aktivitas apa yang paling bikin kamu bersemangat saat mengerjakan tugas atau praktik?',
                'urutan' => 1,
                'opsis' => [
                    ['teks_opsi' => 'Menulis kode, membuat aplikasi, website, atau game', 'kode' => 'PPLG', 'bobot' => 2],
                    ['teks_opsi' => 'Membongkar, servis, dan menyetel mesin serta kelistrikan sepeda motor', 'kode' => 'TBSM', 'bobot' => 2],
                    ['teks_opsi' => 'Menghitung transaksi, menyusun pembukuan, dan mengelola laporan keuangan', 'kode' => 'AKL', 'bobot' => 2],
                    ['teks_opsi' => 'Mengelola arsip, administrasi perkantoran, jadwal, dan korespondensi', 'kode' => 'MPLB', 'bobot' => 2],
                    ['teks_opsi' => 'Bercocok tanam, merawat tanaman, dan mengelola budidaya pertanian', 'kode' => 'ATPH', 'bobot' => 2],
                    ['teks_opsi' => 'Merakit rangkaian elektronika, sensor, dan perangkat kontrol industri', 'kode' => 'TEI', 'bobot' => 2],
                ],
            ],
            [
                'pertanyaan' => 'Lingkungan praktik atau kerja seperti apa yang paling cocok buat kamu?',
                'urutan' => 2,
                'opsis' => [
                    ['teks_opsi' => 'Di depan komputer merancang alur logika dan antarmuka digital', 'kode' => 'PPLG', 'bobot' => 2],
                    ['teks_opsi' => 'Di bengkel otomotif langsung menangani unit kendaraan dan peralatan mekanik', 'kode' => 'TBSM', 'bobot' => 2],
                    ['teks_opsi' => 'Bekerja teliti dengan angka, jurnal keuangan, dan spreadsheet', 'kode' => 'AKL', 'bobot' => 2],
                    ['teks_opsi' => 'Di lingkungan kantor yang terstruktur, komunikatif, dan rapi secara dokumen', 'kode' => 'MPLB', 'bobot' => 2],
                    ['teks_opsi' => 'Di lahan praktik, green house, atau area agraris sambil mengamati pertumbuhan tanaman', 'kode' => 'ATPH', 'bobot' => 2],
                    ['teks_opsi' => 'Di laboratorium elektronika menguji PCB, komponen, dan sistem otomasi', 'kode' => 'TEI', 'bobot' => 2],
                ],
            ],
            [
                'pertanyaan' => 'Masalah atau tantangan seperti apa yang paling menarik untuk kamu pecahkan?',
                'urutan' => 3,
                'opsis' => [
                    ['teks_opsi' => 'Mencari dan memperbaiki bug program agar aplikasi berjalan lancar', 'kode' => 'PPLG', 'bobot' => 2],
                    ['teks_opsi' => 'Mendiagnosa penyebab motor brebet, mogok, atau bermasalah di jalan', 'kode' => 'TBSM', 'bobot' => 2],
                    ['teks_opsi' => 'Menyelidiki selisih saldo agar pembukuan akurat dan sesuai standar', 'kode' => 'AKL', 'bobot' => 2],
                    ['teks_opsi' => 'Merapikan alur kerja administrasi agar pelayanan dan surat-menyurat cepat selesai', 'kode' => 'MPLB', 'bobot' => 2],
                    ['teks_opsi' => 'Mengatasi hama, penyakit tanaman, atau optimasi media tanam dan panen', 'kode' => 'ATPH', 'bobot' => 2],
                    ['teks_opsi' => 'Memperbaiki rangkaian elektronika yang korslet atau menyetel sistem kontrol otomatis', 'kode' => 'TEI', 'bobot' => 2],
                ],
            ],
        ];

        foreach ($dataKuis as $item) {
            $soal = KuisSoal::firstOrCreate(
                ['pertanyaan' => $item['pertanyaan']],
                ['urutan' => $item['urutan']]
            );

            if ($soal->opsis()->count() === 0) {
                foreach ($item['opsis'] as $opsi) {
                    KuisOpsi::create([
                        'kuis_soal_id' => $soal->id,
                        'jurusan_id' => $resolveJurusanId($opsi['kode']),
                        'teks_opsi' => $opsi['teks_opsi'],
                        'bobot' => $opsi['bobot'],
                    ]);
                }
            }
        }
    }
}