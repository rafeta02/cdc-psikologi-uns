<?php

namespace Database\Seeders;

use App\Models\CompetenceItem;
use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetenceItemsTableSeeder extends Seeder
{
    public function run()
    {
        // Get competences to associate with items
        $asesmen = Competence::where('name', 'Asesmen Psikologi')->first();
        $konseling = Competence::where('name', 'Konseling dan Psikoterapi')->first();
        $klinis = Competence::where('name', 'Psikologi Klinis')->first();
        $pendidikan = Competence::where('name', 'Psikologi Pendidikan')->first();
        $industri = Competence::where('name', 'Psikologi Industri')->first();
        $penelitian = Competence::where('name', 'Penelitian Psikologi')->first();

        $competenceItems = [
            // Asesmen Psikologi Items
            [
                'name' => 'Tes Intelegensi (WAIS, WISC)',
                'description' => 'Kemampuan menggunakan dan menginterpretasi tes intelegensi',
                'source' => 'Standar praktik psikologi',
                'competence_id' => $asesmen->id
            ],
            [
                'name' => 'Tes Kepribadian (MMPI, 16PF)',
                'description' => 'Kemampuan menggunakan dan menginterpretasi tes kepribadian',
                'source' => 'Manual tes psikologi',
                'competence_id' => $asesmen->id
            ],
            [
                'name' => 'Observasi Perilaku',
                'description' => 'Teknik observasi sistematis terhadap perilaku klien',
                'source' => 'Metode penelitian psikologi',
                'competence_id' => $asesmen->id
            ],

            // Konseling dan Psikoterapi Items
            [
                'name' => 'Teknik Konseling Person-Centered',
                'description' => 'Penerapan pendekatan Rogers dalam konseling',
                'source' => 'Carl Rogers theory',
                'competence_id' => $konseling->id
            ],
            [
                'name' => 'Cognitive Behavioral Therapy (CBT)',
                'description' => 'Penerapan teknik terapi kognitif perilaku',
                'source' => 'Beck & Ellis CBT manual',
                'competence_id' => $konseling->id
            ],
            [
                'name' => 'Teknik Refleksi dan Empati',
                'description' => 'Kemampuan menunjukkan empati dan refleksi dalam konseling',
                'source' => 'Basic counseling skills',
                'competence_id' => $konseling->id
            ],

            // Psikologi Klinis Items
            [
                'name' => 'Diagnosis Gangguan Mental (DSM-5)',
                'description' => 'Kemampuan mendiagnosis menggunakan kriteria DSM-5',
                'source' => 'DSM-5 Manual',
                'competence_id' => $klinis->id
            ],
            [
                'name' => 'Terapi Kelompok',
                'description' => 'Kemampuan memfasilitasi terapi dalam setting kelompok',
                'source' => 'Group therapy manual',
                'competence_id' => $klinis->id
            ],
            [
                'name' => 'Manajemen Krisis',
                'description' => 'Penanganan situasi krisis psikologis',
                'source' => 'Crisis intervention handbook',
                'competence_id' => $klinis->id
            ],

            // Psikologi Pendidikan Items
            [
                'name' => 'Asesmen Kesulitan Belajar',
                'description' => 'Identifikasi dan asesmen learning disabilities',
                'source' => 'Educational psychology',
                'competence_id' => $pendidikan->id
            ],
            [
                'name' => 'Konseling Akademik',
                'description' => 'Konseling untuk masalah akademik siswa',
                'source' => 'School counseling guide',
                'competence_id' => $pendidikan->id
            ],

            // Psikologi Industri Items
            [
                'name' => 'Rekrutmen dan Seleksi',
                'description' => 'Proses psikologis dalam rekrutmen karyawan',
                'source' => 'Industrial psychology',
                'competence_id' => $industri->id
            ],
            [
                'name' => 'Assessment Center',
                'description' => 'Metode asesmen untuk pengembangan SDM',
                'source' => 'HR assessment manual',
                'competence_id' => $industri->id
            ],

            // Penelitian Psikologi Items
            [
                'name' => 'Metode Kuantitatif',
                'description' => 'Desain penelitian dan analisis statistik',
                'source' => 'Research methodology',
                'competence_id' => $penelitian->id
            ],
            [
                'name' => 'Metode Kualitatif',
                'description' => 'Penelitian kualitatif dalam psikologi',
                'source' => 'Qualitative research methods',
                'competence_id' => $penelitian->id
            ]
        ];

        foreach ($competenceItems as $item) {
            CompetenceItem::create($item);
        }
    }
} 