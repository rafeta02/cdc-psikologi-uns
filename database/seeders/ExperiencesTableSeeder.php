<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperiencesTableSeeder extends Seeder
{
    public function run()
    {
        $experiences = [
            [
                'name' => 'Fresh Graduate',
                'slug' => 'fresh-graduate',
                'description' => 'Lulusan baru tanpa pengalaman kerja'
            ],
            [
                'name' => '1-2 Tahun',
                'slug' => '1-2-tahun',
                'description' => 'Pengalaman kerja 1-2 tahun'
            ],
            [
                'name' => '3-5 Tahun',
                'slug' => '3-5-tahun',
                'description' => 'Pengalaman kerja 3-5 tahun'
            ],
            [
                'name' => '6-10 Tahun',
                'slug' => '6-10-tahun',
                'description' => 'Pengalaman kerja 6-10 tahun'
            ],
            [
                'name' => 'Lebih dari 10 Tahun',
                'slug' => 'lebih-dari-10-tahun',
                'description' => 'Pengalaman kerja lebih dari 10 tahun'
            ]
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
} 