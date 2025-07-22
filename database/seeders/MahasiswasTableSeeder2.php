<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class MahasiswasTableSeeder2 extends Seeder
{
    public function run()
    {
        // Get admin user
        $adminUser = User::first();

        // Create some sample users for mahasiswa if needed
        $users = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@student.uns.ac.id',
                'password' => bcrypt('password'),
                'verified' => 1,
                'approved' => 1,
                'verified_at' => '22-07-2024 03:14:16',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@student.uns.ac.id',
                'password' => bcrypt('password'),
                'verified' => 1,
                'approved' => 1,
                'verified_at' => '22-07-2024 03:14:16',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@student.uns.ac.id',
                'password' => bcrypt('password'),
                'verified' => 1,
                'approved' => 1,
                'verified_at' => '22-07-2024 03:14:16',
            ]
        ];

        foreach ($users as $userData) {
            User::withoutEvents(function () use ($userData) {
                return User::create($userData);
            });
        }

        // Get created users
        $user1 = User::where('email', 'ahmad.rizki@student.uns.ac.id')->first();
        $user2 = User::where('email', 'siti.nurhaliza@student.uns.ac.id')->first();
        $user3 = User::where('email', 'budi.santoso@student.uns.ac.id')->first();

        $mahasiswas = [
            [
                'nim' => 'M0520001',
                'angkatan' => '2020',
                'jurusan' => '01',
                'user_id' => $user1->id
            ],
            [
                'nim' => 'M0521002',
                'angkatan' => '2021',
                'jurusan' => '01',
                'user_id' => $user2->id
            ],
            [
                'nim' => 'M0522003',
                'angkatan' => '2022',
                'jurusan' => '01',
                'user_id' => $user3->id
            ],
            [
                'nim' => 'M0520004',
                'angkatan' => '2020',
                'jurusan' => '01',
                'user_id' => $adminUser->id
            ]
        ];

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
} 