<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => 'Anxiety', 'description' => 'Tag untuk artikel tentang kecemasan', 'featured' => 1],
            ['name' => 'Depression', 'description' => 'Tag untuk artikel tentang depresi', 'featured' => 1],
            ['name' => 'Stress Management', 'description' => 'Tag untuk artikel tentang manajemen stres', 'featured' => 1],
            ['name' => 'Child Psychology', 'description' => 'Tag untuk artikel tentang psikologi anak', 'featured' => 0],
            ['name' => 'Cognitive Therapy', 'description' => 'Tag untuk artikel tentang terapi kognitif', 'featured' => 0],
            ['name' => 'Behavioral Therapy', 'description' => 'Tag untuk artikel tentang terapi perilaku', 'featured' => 0],
            ['name' => 'Group Therapy', 'description' => 'Tag untuk artikel tentang terapi kelompok', 'featured' => 0],
            ['name' => 'Family Therapy', 'description' => 'Tag untuk artikel tentang terapi keluarga', 'featured' => 0],
            ['name' => 'Personality Disorders', 'description' => 'Tag untuk artikel tentang gangguan kepribadian', 'featured' => 0],
            ['name' => 'Learning Disabilities', 'description' => 'Tag untuk artikel tentang kesulitan belajar', 'featured' => 0],
            ['name' => 'Motivation', 'description' => 'Tag untuk artikel tentang motivasi', 'featured' => 1],
            ['name' => 'Self Esteem', 'description' => 'Tag untuk artikel tentang harga diri', 'featured' => 0],
            ['name' => 'Relationship', 'description' => 'Tag untuk artikel tentang hubungan interpersonal', 'featured' => 1],
            ['name' => 'Workplace Psychology', 'description' => 'Tag untuk artikel tentang psikologi kerja', 'featured' => 0],
            ['name' => 'Mental Health', 'description' => 'Tag untuk artikel tentang kesehatan mental', 'featured' => 1]
        ];

        foreach ($tags as $tag) {
            ArticleTag::create($tag);
        }
    }
} 