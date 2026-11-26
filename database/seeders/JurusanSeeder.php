<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode' => 'PPLG',
                'nama' => 'Pengembangan Perangkat Lunak & Gim',
                'deskripsi' => 'Mempelajari pemrograman web, pembuatan aplikasi mobile, pengembangan gim, serta rekayasa perangkat lunak modern.',
                'ikon' => 'monitor',
                'urutan' => 1,
            ],
            [
                'kode' => 'AKL',
                'nama' => 'Akuntansi & Keuangan Lembaga',
                'deskripsi' => 'Pengelolaan laporan keuangan, perpajakan, dan sistem akuntansi digital instansi.',
                'ikon' => 'dollar-sign',
                'urutan' => 2,
            ],
            [
                'kode' => 'TBSM',
                'nama' => 'Teknik Bisnis Sepeda Motor',
                'deskripsi' => 'Perawatan, perbaikan, dan diagnosa mesin sepeda motor konvensional & injeksi.',
                'ikon' => 'settings',
                'urutan' => 3,
            ],
            [
                'kode' => 'MPLB',
                'nama' => 'Manajemen Perkantoran & Layanan Bisnis',
                'deskripsi' => 'Manajemen administrasi, kearsipan digital, dan korespondensi bisnis modern.',
                'ikon' => 'briefcase',
                'urutan' => 4,
            ],
            [
                'kode' => 'ATPH',
                'nama' => 'Agribisnis Tanaman Pangan & Hortikultura',
                'deskripsi' => 'Mempelajari dasar budidaya tanaman, pengelolaan lahan tani, serta teknik pembibitan pertanian modern.',
                'ikon' => 'leaf',
                'urutan' => 5,
            ],
            [
                'kode' => 'TEI',
                'nama' => 'Teknik Elektronika Industri',
                'deskripsi' => 'Pengenalan dasar komponen elektronika, perakitan sirkuit kontrol, serta pemeliharaan sistem digital industri.',
                'ikon' => 'zap',
                'urutan' => 6,
            ],
        ];

        foreach ($data as $item) {
            Jurusan::updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}