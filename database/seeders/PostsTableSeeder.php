<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // Get admin user for author and creator
        $adminUser = User::first();

        $posts = [
            [
                'title' => 'Memahami Gangguan Kecemasan pada Remaja',
                'content' => 'Gangguan kecemasan pada remaja merupakan masalah kesehatan mental yang semakin umum terjadi. Artikel ini membahas tanda-tanda, penyebab, dan cara penanganan yang tepat untuk membantu remaja mengatasi kecemasan mereka. Dengan pemahaman yang baik dari orang tua dan pendidik, remaja dapat mendapatkan dukungan yang mereka butuhkan.',
                'excerpt' => 'Panduan lengkap untuk memahami dan menangani gangguan kecemasan pada remaja',
                'meta_title' => 'Gangguan Kecemasan Remaja - Panduan Lengkap',
                'meta_description' => 'Pelajari cara mengidentifikasi dan menangani gangguan kecemasan pada remaja dengan pendekatan yang tepat.',
                'status' => 'published',
                'featured' => 1,
                'author_id' => $adminUser->id,
                'created_by_id' => $adminUser->id
            ],
            [
                'title' => 'Pentingnya Kesehatan Mental di Tempat Kerja',
                'content' => 'Kesehatan mental karyawan merupakan aset berharga bagi perusahaan. Artikel ini menguraikan dampak kesehatan mental terhadap produktivitas, cara menciptakan lingkungan kerja yang mendukung, dan strategi untuk mengatasi stres kerja. Program kesehatan mental yang baik dapat meningkatkan kepuasan kerja dan mengurangi turnover.',
                'excerpt' => 'Mengapa kesehatan mental karyawan penting untuk kesuksesan perusahaan',
                'meta_title' => 'Kesehatan Mental Karyawan - Kunci Sukses Perusahaan',
                'meta_description' => 'Pelajari pentingnya menjaga kesehatan mental karyawan untuk meningkatkan produktivitas dan kesejahteraan di tempat kerja.',
                'status' => 'published',
                'featured' => 1,
                'author_id' => $adminUser->id,
                'created_by_id' => $adminUser->id
            ],
            [
                'title' => 'Terapi Kognitif Perilaku untuk Depresi',
                'content' => 'Terapi Kognitif Perilaku (CBT) adalah salah satu pendekatan terapi yang paling efektif untuk menangani depresi. Artikel ini menjelaskan prinsip-prinsip dasar CBT, teknik-teknik yang digunakan, dan bagaimana terapi ini membantu pasien mengubah pola pikir dan perilaku yang tidak sehat. Dengan pemahaman yang tepat, CBT dapat menjadi alat yang powerful untuk pemulihan.',
                'excerpt' => 'Memahami cara kerja dan manfaat Terapi Kognitif Perilaku dalam mengatasi depresi',
                'meta_title' => 'CBT untuk Depresi - Panduan Terapi Efektif',
                'meta_description' => 'Pelajari bagaimana Terapi Kognitif Perilaku dapat membantu mengatasi depresi secara efektif.',
                'status' => 'published',
                'featured' => 0,
                'author_id' => $adminUser->id,
                'created_by_id' => $adminUser->id
            ],
            [
                'title' => 'Psikologi Perkembangan Anak Usia Dini',
                'content' => 'Masa anak usia dini adalah periode kritis dalam perkembangan psikologi. Artikel ini membahas tahapan perkembangan kognitif, emosional, dan sosial anak, serta faktor-faktor yang mempengaruhinya. Pemahaman tentang psikologi perkembangan anak dapat membantu orang tua dan pendidik dalam memberikan stimulasi yang tepat.',
                'excerpt' => 'Memahami tahapan perkembangan psikologi pada anak usia dini',
                'meta_title' => 'Psikologi Perkembangan Anak - Panduan Orang Tua',
                'meta_description' => 'Pelajari tahapan perkembangan psikologi anak usia dini untuk memberikan stimulasi yang optimal.',
                'status' => 'published',
                'featured' => 0,
                'author_id' => $adminUser->id,
                'created_by_id' => $adminUser->id
            ],
            [
                'title' => 'Mengatasi Trauma Psikologis: Pendekatan EMDR',
                'content' => 'Eye Movement Desensitization and Reprocessing (EMDR) adalah metode terapi yang efektif untuk mengatasi trauma psikologis. Artikel ini menjelaskan bagaimana EMDR bekerja, siapa yang dapat menggunakannya, dan proses terapi yang dilakukan. Dengan pendekatan yang tepat, trauma dapat diolah dan dipulihkan.',
                'excerpt' => 'Memahami terapi EMDR sebagai solusi efektif untuk trauma psikologis',
                'meta_title' => 'Terapi EMDR untuk Trauma - Metode Penyembuhan',
                'meta_description' => 'Pelajari bagaimana terapi EMDR dapat membantu mengatasi trauma psikologis dengan efektif.',
                'status' => 'draft',
                'featured' => 0,
                'author_id' => $adminUser->id,
                'created_by_id' => $adminUser->id
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
} 