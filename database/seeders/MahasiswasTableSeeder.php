<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MahasiswasTableSeeder extends Seeder
{
    public function run()
    {
        // Try creating just one record to isolate the issue
        try {
            // Simply create a single user
            $user = User::create([
                'name' => 'Test Mahasiswa',
                'email' => 'test.mahasiswa@example.com',
                'password' => bcrypt('password'),
                'username' => 'testmahasiswa',
                'level' => 'student',
                'verified' => 1,
                'approved' => 1,
            ]);

            $user->roles()->sync(1);
            
            // Create the mahasiswa record
            Mahasiswa::create([
                'nim' => '20230001',
                'angkatan' => '2023',
                'jurusan' => '01',
                'user_id' => $user->id,
            ]);
            
            if ($this->command) {
                $this->command->info('Created a test mahasiswa record');
            }
            
        } catch (\Exception $e) {
            Log::error('Error in MahasiswasTableSeeder: ' . $e->getMessage());
            throw new \Exception('Failed to seed mahasiswas: ' . $e->getMessage());
        }
    }
} 