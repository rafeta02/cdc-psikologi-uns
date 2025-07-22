<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetencesTableSeeder extends Seeder
{
    public function run()
    {
        $competences = [
            [
                'name' => 'Asesmen Psikologi',
                'description' => 'Kemampuan melakukan asesmen dan evaluasi psikologis menggunakan berbagai alat tes dan teknik observasi'
            ],
            [
                'name' => 'Konseling dan Psikoterapi',
                'description' => 'Kemampuan memberikan layanan konseling dan terapi untuk membantu klien mengatasi masalah psikologis'
            ],
            [
                'name' => 'Psikologi Klinis',
                'description' => 'Kompetensi dalam mendiagnosis dan menangani gangguan mental serta masalah kesehatan mental'
            ],
            [
                'name' => 'Psikologi Pendidikan',
                'description' => 'Kemampuan memahami dan menerapkan prinsip psikologi dalam konteks pendidikan dan pembelajaran'
            ],
            [
                'name' => 'Psikologi Industri',
                'description' => 'Kompetensi dalam menerapkan psikologi di lingkungan kerja dan organisasi'
            ],
            [
                'name' => 'Penelitian Psikologi',
                'description' => 'Kemampuan merancang, melaksanakan, dan menganalisis penelitian dalam bidang psikologi'
            ],
            [
                'name' => 'Etika Profesional',
                'description' => 'Pemahaman dan penerapan kode etik dalam praktik psikologi profesional'
            ],
            [
                'name' => 'Komunikasi Terapeutik',
                'description' => 'Kemampuan berkomunikasi secara efektif dengan klien dalam setting terapeutik'
            ]
        ];

        foreach ($competences as $competence) {
            Competence::create($competence);
        }
    }
} 