<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        VisiMisi::updateOrCreate(
            ['jenis' => 'visi'],
            [
                'isi' => 'Terwujudnya lulusan yang berakhlak mulia, kompeten, mandiri, dan berdaya saing global.',
                'urutan' => 1,
            ]
        );

        $misis = [
            'Menanamkan nilai-nilai keimanan, ketakwaan, dan budi pekerti luhur.',
            'Menyelenggarakan pembelajaran berbasis kompetensi dan teknologi sesuai kebutuhan dunia industri.',
            'Membangun kemitraan strategis dengan dunia usaha dan dunia industri (DUDI).',
        ];

        foreach ($misis as $index => $isi) {
            VisiMisi::firstOrCreate(
                ['jenis' => 'misi', 'urutan' => $index + 1],
                ['isi' => $isi]
            );
        }
    }
}