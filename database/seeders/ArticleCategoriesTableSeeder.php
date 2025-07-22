<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Psikologi Klinis',
                'description' => 'Artikel tentang psikologi klinis dan terapi'
            ],
            [
                'name' => 'Psikologi Pendidikan',
                'description' => 'Artikel tentang psikologi dalam konteks pendidikan'
            ],
            [
                'name' => 'Psikologi Sosial',
                'description' => 'Artikel tentang perilaku sosial dan interaksi manusia'
            ],
            [
                'name' => 'Psikologi Perkembangan',
                'description' => 'Artikel tentang perkembangan psikologi sepanjang hidup'
            ],
            [
                'name' => 'Psikologi Industri',
                'description' => 'Artikel tentang psikologi di tempat kerja dan organisasi'
            ],
            [
                'name' => 'Kesehatan Mental',
                'description' => 'Artikel tentang kesehatan mental dan wellbeing'
            ],
            [
                'name' => 'Riset Psikologi',
                'description' => 'Artikel tentang penelitian dan metodologi psikologi'
            ],
            [
                'name' => 'Konseling',
                'description' => 'Artikel tentang praktik konseling dan bimbingan'
            ]
        ];

        foreach ($categories as $category) {
            ArticleCategory::create($category);
        }
    }
} 