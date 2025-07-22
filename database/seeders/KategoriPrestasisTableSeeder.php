<?php

namespace Database\Seeders;

use App\Models\KategoriPrestasi;
use Illuminate\Database\Seeder;

class KategoriPrestasisTableSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            [
                'name' => 'Akademik',
                'description' => 'Prestasi dalam bidang akademik dan pembelajaran'
            ],
            [
                'name' => 'Penelitian',
                'description' => 'Prestasi dalam bidang penelitian dan publikasi ilmiah'
            ],
            [
                'name' => 'Kompetisi Psikologi',
                'description' => 'Prestasi dalam kompetisi atau lomba psikologi'
            ],
            [
                'name' => 'Organisasi',
                'description' => 'Prestasi dalam kegiatan organisasi mahasiswa'
            ],
            [
                'name' => 'Komunitas',
                'description' => 'Prestasi dalam kegiatan pengabdian masyarakat'
            ],
            [
                'name' => 'Internasional',
                'description' => 'Prestasi dalam skala internasional'
            ],
            [
                'name' => 'Nasional',
                'description' => 'Prestasi dalam skala nasional'
            ],
            [
                'name' => 'Regional',
                'description' => 'Prestasi dalam skala regional atau daerah'
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriPrestasi::create($kategori);
        }
    }
} 