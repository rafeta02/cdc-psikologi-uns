<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Experience;
use App\Models\Position;
use App\Models\Industry;
use App\Models\User;
use Illuminate\Database\Seeder;

class VacanciesTableSeeder extends Seeder
{
    public function run()
    {
        // Get related models
        $companies = Company::all();
        $experiences = Experience::all();
        $positions = Position::all();
        $industries = Industry::all();
        $adminUser = User::first();

        $vacancies = [
            [
                'name' => 'Psikolog Klinis - Klinik Sehat Jiwa',
                'company_id' => $companies->where('name', 'Klinik Psikologi Sehat Jiwa')->first()->id,
                'description' => 'Mencari psikolog klinis berpengalaman untuk menangani berbagai kasus gangguan mental. Kandidat harus memiliki lisensi praktik dan pengalaman minimal 2 tahun.',
                'type' => 'fulltime',
                'open_date' => '01/01/2024',
                'close_date_exist' => 1,
                'close_date' => '31/03/2024',
                'persyaratan_umum' => 'S1/S2 Psikologi, Lisensi praktik, Komunikasi yang baik, Empati tinggi',
                'persyaratan_khusus' => 'Pengalaman klinis minimal 2 tahun, Familiar dengan DSM-5, Kemampuan asesmen psikologi',
                'registration' => 'Kirim CV dan portfolio ke info@sehatjiwa.com',
                'job_description' => 'Melakukan asesmen psikologi, memberikan terapi, konsultasi dengan tim medis, membuat laporan klinis',
                'experience_id' => $experiences->where('name', '1-2 Tahun')->first()->id,
                'minimum_gpa' => 3.25,
                'position_id' => $positions->where('name', 'Psikolog Klinis')->first()->id,
                'industry_id' => $industries->where('name', 'Kesehatan Mental')->first()->id,
                'featured' => 1,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'Konselor Pendidikan - Universitas Sebelas Maret',
                'company_id' => $companies->where('name', 'Universitas Sebelas Maret')->first()->id,
                'description' => 'Universitas Sebelas Maret membuka kesempatan untuk posisi konselor pendidikan di Fakultas Psikologi. Fresh graduate dipersilahkan melamar.',
                'type' => 'fulltime',
                'open_date' => '15/02/2024',
                'close_date_exist' => 1,
                'close_date' => '15/04/2024',
                'persyaratan_umum' => 'S1 Psikologi minimal, IPK minimal 3.0, Kemampuan komunikasi yang baik',
                'persyaratan_khusus' => 'Memahami psikologi pendidikan, Berpengalaman dalam konseling akademik, Mampu bekerja dalam tim',
                'registration' => 'Daftar melalui portal karir UNS atau email ke hr@uns.ac.id',
                'job_description' => 'Memberikan konseling akademik kepada mahasiswa, membantu mengatasi masalah belajar, koordinasi dengan dosen',
                'experience_id' => $experiences->where('name', 'Fresh Graduate')->first()->id,
                'minimum_gpa' => 3.0,
                'position_id' => $positions->where('name', 'Konselor')->first()->id,
                'industry_id' => $industries->where('name', 'Pendidikan')->first()->id,
                'featured' => 1,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'HR Specialist - Human Capital Indonesia',
                'company_id' => $companies->where('name', 'Human Capital Indonesia')->first()->id,
                'description' => 'Posisi HR Specialist dengan background psikologi untuk menangani rekrutmen dan pengembangan SDM.',
                'type' => 'fulltime',
                'open_date' => '10/03/2024',
                'close_date_exist' => 0,
                'close_date' => null,
                'persyaratan_umum' => 'S1 Psikologi, Pengalaman HR minimal 3 tahun, Kemampuan analisis yang baik',
                'persyaratan_khusus' => 'Berpengalaman dalam rekrutmen, Familiar dengan tes psikologi, Sertifikasi HR diutamakan',
                'registration' => 'Apply online di website HCI atau email ke recruitment@hci-bandung.co.id',
                'job_description' => 'Rekrutmen dan seleksi karyawan, asesmen psikologi, pengembangan program training, analisis kebutuhan SDM',
                'experience_id' => $experiences->where('name', '3-5 Tahun')->first()->id,
                'minimum_gpa' => 3.0,
                'position_id' => $positions->where('name', 'HR Specialist')->first()->id,
                'industry_id' => $industries->where('name', 'Human Resources')->first()->id,
                'featured' => 0,
                'created_by_id' => $adminUser->id
            ],
            [
                'name' => 'Asisten Psikolog - RS Dr. Moewardi',
                'company_id' => $companies->where('name', 'RS Dr. Moewardi Surakarta')->first()->id,
                'description' => 'Rumah Sakit Dr. Moewardi mencari asisten psikolog untuk unit kesehatan jiwa. Posisi ini cocok untuk fresh graduate yang ingin mengembangkan karir di bidang psikologi klinis.',
                'type' => 'fulltime',
                'open_date' => '20/02/2024',
                'close_date_exist' => 1,
                'close_date' => '20/04/2024',
                'persyaratan_umum' => 'S1 Psikologi, Fresh graduate welcome, Kemampuan kerja tim yang baik',
                'persyaratan_khusus' => 'Minat pada bidang kesehatan mental, Kemampuan observasi yang baik, Siap bekerja shift',
                'registration' => 'Daftar melalui website RS atau datang langsung ke bagian HRD',
                'job_description' => 'Membantu psikolog senior dalam asesmen, observasi pasien, administrasi klinis, dukungan terapi kelompok',
                'experience_id' => $experiences->where('name', 'Fresh Graduate')->first()->id,
                'minimum_gpa' => 2.75,
                'position_id' => $positions->where('name', 'Asisten Psikolog')->first()->id,
                'industry_id' => $industries->where('name', 'Rumah Sakit & Klinik')->first()->id,
                'featured' => 0,
                'created_by_id' => $adminUser->id
            ]
        ];

        foreach ($vacancies as $vacancy) {
            Vacancy::create($vacancy);
        }
    }
} 