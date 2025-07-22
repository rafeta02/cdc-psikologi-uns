<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{
    public function run()
    {
        $industries = [
            [
                'name' => 'Kesehatan Mental',
                'description' => 'Industri yang fokus pada layanan kesehatan mental dan psikologis',
                'featured' => 1
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Industri pendidikan dan lembaga pembelajaran',
                'featured' => 1
            ],
            [
                'name' => 'Rumah Sakit & Klinik',
                'description' => 'Fasilitas kesehatan dan layanan medis',
                'featured' => 1
            ],
            [
                'name' => 'Konsultan Psikologi',
                'description' => 'Jasa konsultasi dan layanan psikologi profesional',
                'featured' => 1
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Bidang sumber daya manusia dan pengembangan SDM',
                'featured' => 0
            ],
            [
                'name' => 'Teknologi Informasi',
                'description' => 'Perusahaan teknologi dan pengembangan aplikasi',
                'featured' => 0
            ],
            [
                'name' => 'Organisasi Non-Profit',
                'description' => 'Lembaga sosial dan organisasi kemanusiaan',
                'featured' => 0
            ],
            [
                'name' => 'Pemerintahan',
                'description' => 'Instansi pemerintah dan layanan publik',
                'featured' => 0
            ],
            [
                'name' => 'Riset & Pengembangan',
                'description' => 'Lembaga penelitian dan pengembangan ilmiah',
                'featured' => 0
            ],
            [
                'name' => 'Media & Komunikasi',
                'description' => 'Perusahaan media, periklanan, dan komunikasi',
                'featured' => 0
            ]
        ];

        foreach ($industries as $industry) {
            Industry::create($industry);
        }
    }
} 