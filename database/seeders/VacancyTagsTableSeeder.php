<?php

namespace Database\Seeders;

use App\Models\VacancyTag;
use Illuminate\Database\Seeder;

class VacancyTagsTableSeeder extends Seeder
{
    public function run()
    {
        $vacancyTags = [
            [
                'name' => 'Full Time',
                'description' => 'Pekerjaan penuh waktu'
            ],
            [
                'name' => 'Part Time',
                'description' => 'Pekerjaan paruh waktu'
            ],
            [
                'name' => 'Remote Work',
                'description' => 'Pekerjaan yang dapat dilakukan dari jarak jauh'
            ],
            [
                'name' => 'Fresh Graduate',
                'description' => 'Terbuka untuk lulusan baru'
            ],
            [
                'name' => 'Experienced',
                'description' => 'Membutuhkan pengalaman kerja'
            ],
            [
                'name' => 'Clinical Setting',
                'description' => 'Lingkungan kerja klinis'
            ],
            [
                'name' => 'Educational Setting',
                'description' => 'Lingkungan kerja pendidikan'
            ],
            [
                'name' => 'Private Practice',
                'description' => 'Praktik pribadi'
            ],
            [
                'name' => 'Research',
                'description' => 'Fokus pada penelitian'
            ],
            [
                'name' => 'Therapy',
                'description' => 'Fokus pada terapi'
            ]
        ];

        foreach ($vacancyTags as $tag) {
            VacancyTag::create($tag);
        }
    }
} 