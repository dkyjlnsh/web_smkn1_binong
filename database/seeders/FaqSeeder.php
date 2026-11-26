<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'urutan'     => 1,
                'pertanyaan' => 'Kapan pendaftaran siswa baru (PPDB) dibuka?',
                'jawaban'    => 'Pendaftaran biasanya dibuka dalam 2–3 gelombang mulai bulan Mei hingga Juli setiap tahunnya. Informasi resmi tanggal pelaksanaan akan diupdate berkala di halaman utama website.',
            ],
            [
                'urutan'     => 2,
                'pertanyaan' => 'Apakah siswa PPLG mendapatkan fasilitas laptop dari sekolah?',
                'jawaban'    => 'Sekolah menyediakan fasilitas Lab Komputer modern dengan spesifikasi tinggi yang dapat digunakan selama jam pelajaran. Namun, siswa sangat disarankan memiliki perangkat mandiri untuk belajar di rumah.',
            ],
            [
                'urutan'     => 3,
                'pertanyaan' => 'Bagaimana dengan penyaluran kerja bagi lulusan?',
                'jawaban'    => 'Melalui BKK (Bursa Kerja Khusus) SMKN 1 Binong, kami bekerja sama dengan puluhan perusahaan nasional untuk menyelenggarakan rekrutmen langsung sebelum siswa dinyatakan lulus.',
            ],
        ];

        foreach ($faqs as $item) {
            Faq::firstOrCreate(
                ['pertanyaan' => $item['pertanyaan']],
                [
                    'jawaban' => $item['jawaban'],
                    'urutan'  => $item['urutan'],
                ]
            );
        }
    }
}