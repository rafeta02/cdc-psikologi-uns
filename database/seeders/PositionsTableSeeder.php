<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            [
                'name' => 'Psikolog Klinis',
                'description' => 'Psikolog yang menangani diagnosis dan terapi gangguan mental',
                'featured' => 1
            ],
            [
                'name' => 'Konselor',
                'description' => 'Profesional yang memberikan layanan konseling dan bimbingan',
                'featured' => 1
            ],
            [
                'name' => 'Psikolog Pendidikan',
                'description' => 'Psikolog yang fokus pada masalah pembelajaran dan pendidikan',
                'featured' => 1
            ],
            [
                'name' => 'HR Specialist',
                'description' => 'Spesialis sumber daya manusia dengan latar belakang psikologi',
                'featured' => 1
            ],
            [
                'name' => 'Terapis',
                'description' => 'Praktisi terapi untuk berbagai gangguan psikologis',
                'featured' => 0
            ],
            [
                'name' => 'Peneliti Psikologi',
                'description' => 'Peneliti yang fokus pada studi dan riset psikologi',
                'featured' => 0
            ],
            [
                'name' => 'Koordinator Program',
                'description' => 'Koordinator program kesehatan mental atau pendidikan',
                'featured' => 0
            ],
            [
                'name' => 'Asisten Psikolog',
                'description' => 'Asisten profesional dalam layanan psikologi',
                'featured' => 0
            ],
            [
                'name' => 'Dosen Psikologi',
                'description' => 'Pengajar di perguruan tinggi bidang psikologi',
                'featured' => 0
            ],
            [
                'name' => 'Child Psychologist',
                'description' => 'Psikolog yang khusus menangani anak-anak',
                'featured' => 0
            ]
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
} 