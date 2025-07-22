<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class MagangsTableSeeder extends Seeder
{
    public function run()
    {
        // Get related models
        $companies = Company::all();
        $adminUser = User::first();

        $magangs = [
            [
                'name' => 'Program Magang Psikologi Klinis - Klinik Sehat Jiwa',
                'company_id' => $companies->where('name', 'Klinik Psikologi Sehat Jiwa')->first()->id,
                'description' => 'Program magang yang memberikan kesempatan kepada mahasiswa psikologi untuk belajar praktik klinis langsung di bawah supervisi psikolog berpengalaman. Peserta akan mendapatkan exposure terhadap berbagai kasus dan teknik terapi.',
                'type' => 'REGULER',
                'open_date' => '01/03/2024',
                'close_date_exist' => 1,
                'close_date' => '31/05/2024',
                'persyaratan' => 'Mahasiswa semester 6-8 Psikologi, IPK minimal 3.0, Surat rekomendasi dosen, Sertifikat kesehatan',
                'registrasi' => 'Kirim berkas lengkap ke info@sehatjiwa.com dengan subject "Magang Psikologi Klinis"',
                'needs' => 5,
                'filled' => 2,
                'featured' => 1,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'Magang MBKM Psikologi Pendidikan - UNS',
                'company_id' => $companies->where('name', 'Universitas Sebelas Maret')->first()->id,
                'description' => 'Program Magang MBKM di Fakultas Psikologi UNS dengan fokus pada psikologi pendidikan dan konseling akademik. Mahasiswa akan terlibat dalam penelitian dan praktik langsung dengan mahasiswa.',
                'type' => 'MBKM',
                'open_date' => '15/02/2024',
                'close_date_exist' => 1,
                'close_date' => '15/04/2024',
                'persyaratan' => 'Mahasiswa S1 Psikologi dari universitas terakreditasi, Semester 5-7, IPK minimal 3.25, Minat pada bidang pendidikan',
                'registrasi' => 'Daftar melalui sistem MBKM Kemendikbud atau hubungi koordinator MBKM Fakultas Psikologi UNS',
                'needs' => 10,
                'filled' => 7,
                'featured' => 1,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'Program Magang Psikologi Industri - HCI Bandung',
                'company_id' => $companies->where('name', 'Human Capital Indonesia')->first()->id,
                'description' => 'Kesempatan magang di perusahaan konsultan HR untuk belajar aplikasi psikologi dalam dunia industri. Mahasiswa akan terlibat dalam proyek rekrutmen, asesmen, dan pengembangan SDM.',
                'type' => 'REGULER',
                'open_date' => '10/04/2024',
                'close_date_exist' => 0,
                'close_date' => null,
                'persyaratan' => 'Mahasiswa Psikologi semester 6-8, Minat pada HR dan psikologi industri, Kemampuan komunikasi yang baik, Familiar dengan MS Office',
                'registrasi' => 'Email CV dan motivation letter ke internship@hci-bandung.co.id',
                'needs' => 3,
                'filled' => 0,
                'featured' => 0,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'Magang Psikologi Kesehatan - RS Dr. Moewardi',
                'company_id' => $companies->where('name', 'RS Dr. Moewardi Surakarta')->first()->id,
                'description' => 'Program magang di unit kesehatan jiwa RS Dr. Moewardi untuk mahasiswa yang tertarik pada bidang psikologi kesehatan dan psikologi medis. Akan mendapatkan pengalaman bekerja dalam tim medis.',
                'type' => 'REGULER',
                'open_date' => '01/06/2024',
                'close_date_exist' => 1,
                'close_date' => '30/07/2024',
                'persyaratan' => 'Mahasiswa Psikologi semester 7-8, Surat keterangan sehat, Vaksinasi lengkap, Kemampuan beradaptasi dengan lingkungan medis',
                'registrasi' => 'Hubungi bagian Diklat RS Dr. Moewardi atau email ke diklat@rsdmoewardi.co.id',
                'needs' => 4,
                'filled' => 1,
                'featured' => 0,
                'created_by_id' => $adminUser->id
            ]
        ];

        foreach ($magangs as $magang) {
            Magang::create($magang);
        }
    }
} 