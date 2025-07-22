<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationsTableSeeder extends Seeder
{
    public function run()
    {
        $educations = [
            [
                'name' => 'S1 Psikologi',
                'description' => 'Program Sarjana Psikologi',
                'featured' => 1
            ],
            [
                'name' => 'S2 Psikologi Klinis',
                'description' => 'Program Magister Psikologi Klinis',
                'featured' => 1
            ],
            [
                'name' => 'S2 Psikologi Pendidikan',
                'description' => 'Program Magister Psikologi Pendidikan',
                'featured' => 0
            ],
            [
                'name' => 'S2 Psikologi Industri',
                'description' => 'Program Magister Psikologi Industri dan Organisasi',
                'featured' => 0
            ],
            [
                'name' => 'S3 Psikologi',
                'description' => 'Program Doktor Psikologi',
                'featured' => 0
            ],
            [
                'name' => 'Profesi Psikolog',
                'description' => 'Program Profesi Psikolog',
                'featured' => 1
            ],
            [
                'name' => 'Diploma Psikologi Terapan',
                'description' => 'Program Diploma Psikologi Terapan',
                'featured' => 0
            ]
        ];

        foreach ($educations as $education) {
            Education::create($education);
        }
    }
} 