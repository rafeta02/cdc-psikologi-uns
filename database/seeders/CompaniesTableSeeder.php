<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Industry;
use App\Models\Regency;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        // Get some industries and regencies for relationships
        $mentalHealth = Industry::where('name', 'Kesehatan Mental')->first();
        $education = Industry::where('name', 'Pendidikan')->first();
        $hospital = Industry::where('name', 'Rumah Sakit & Klinik')->first();
        $consultant = Industry::where('name', 'Konsultan Psikologi')->first();
        $hr = Industry::where('name', 'Human Resources')->first();

        $surakarta = Regency::where('name', 'Surakarta')->first();
        $yogya = Regency::where('name', 'Yogyakarta')->first();
        $semarang = Regency::where('name', 'Semarang')->first();
        $bandung = Regency::where('name', 'Bandung')->first();
        $jakarta_selatan = Regency::where('name', 'Jakarta Selatan')->first();

        $companies = [
            [
                'name' => 'Klinik Psikologi Sehat Jiwa',
                'description' => 'Klinik psikologi yang menyediakan layanan konseling dan terapi untuk berbagai masalah kesehatan mental',
                'address' => 'Jl. Dr. Radjiman No. 123, Solo',
                'regency_id' => $surakarta->id,
                'telephone' => '0271-123456',
                'email' => 'info@sehatjiwa.com',
                'website' => 'https://sehatjiwa.com',
                'scale' => 'kecil',
                'number_of_employee' => 15,
                'ownership' => 'swasta',
                'industry_id' => $mentalHealth->id,
                'location' => 'Solo, Jawa Tengah',
                'featured' => 1
            ],
            [
                'name' => 'Universitas Sebelas Maret',
                'description' => 'Universitas negeri terkemuka dengan Fakultas Psikologi yang berkualitas',
                'address' => 'Jl. Ir. Sutami 36A, Surakarta',
                'regency_id' => $surakarta->id,
                'telephone' => '0271-646994',
                'email' => 'info@uns.ac.id',
                'website' => 'https://uns.ac.id',
                'scale' => 'besar',
                'number_of_employee' => 2500,
                'ownership' => 'negara',
                'industry_id' => $education->id,
                'location' => 'Solo, Jawa Tengah',
                'featured' => 1
            ],
            [
                'name' => 'RS Dr. Moewardi Surakarta',
                'description' => 'Rumah sakit umum daerah yang menyediakan layanan kesehatan mental dan psikiatri',
                'address' => 'Jl. Kolonel Sutarto No. 132, Surakarta',
                'regency_id' => $surakarta->id,
                'telephone' => '0271-634634',
                'email' => 'info@rsdmoewardi.co.id',
                'website' => 'https://rsdmoewardi.co.id',
                'scale' => 'besar',
                'number_of_employee' => 1200,
                'ownership' => 'negara',
                'industry_id' => $hospital->id,
                'location' => 'Solo, Jawa Tengah',
                'featured' => 1
            ],
            [
                'name' => 'Psikologi Konsultan Nusantara',
                'description' => 'Perusahaan konsultan psikologi yang melayani asesmen dan pengembangan SDM',
                'address' => 'Jl. Malioboro No. 56, Yogyakarta',
                'regency_id' => $yogya->id,
                'telephone' => '0274-565656',
                'email' => 'contact@psikonusa.com',
                'website' => 'https://psikonusa.com',
                'scale' => 'menengah',
                'number_of_employee' => 45,
                'ownership' => 'swasta',
                'industry_id' => $consultant->id,
                'location' => 'Yogyakarta',
                'featured' => 0
            ],
            [
                'name' => 'Center for Psychological Services',
                'description' => 'Pusat layanan psikologi dengan fokus pada terapi keluarga dan anak',
                'address' => 'Jl. Pandanaran No. 88, Semarang',
                'regency_id' => $semarang->id,
                'telephone' => '024-8765432',
                'email' => 'hello@cps-semarang.com',
                'website' => 'https://cps-semarang.com',
                'scale' => 'kecil',
                'number_of_employee' => 12,
                'ownership' => 'swasta',
                'industry_id' => $mentalHealth->id,
                'location' => 'Semarang, Jawa Tengah',
                'featured' => 0
            ],
            [
                'name' => 'Human Capital Indonesia',
                'description' => 'Perusahaan konsultan HR yang menggunakan pendekatan psikologi dalam rekrutmen dan pengembangan karyawan',
                'address' => 'Jl. Dago No. 45, Bandung',
                'regency_id' => $bandung->id,
                'telephone' => '022-2503456',
                'email' => 'info@hci-bandung.co.id',
                'website' => 'https://hci-bandung.co.id',
                'scale' => 'menengah',
                'number_of_employee' => 75,
                'ownership' => 'swasta',
                'industry_id' => $hr->id,
                'location' => 'Bandung, Jawa Barat',
                'featured' => 0
            ],
            [
                'name' => 'Klinik Tumbuh Kembang Anak',
                'description' => 'Klinik khusus yang menangani masalah tumbuh kembang dan psikologi anak',
                'address' => 'Jl. Radio Dalam No. 15, Jakarta Selatan',
                'regency_id' => $jakarta_selatan->id,
                'telephone' => '021-7654321',
                'email' => 'admin@tumbuhkembang.id',
                'website' => 'https://tumbuhkembang.id',
                'scale' => 'kecil',
                'number_of_employee' => 20,
                'ownership' => 'swasta',
                'industry_id' => $mentalHealth->id,
                'location' => 'Jakarta Selatan',
                'featured' => 1
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 