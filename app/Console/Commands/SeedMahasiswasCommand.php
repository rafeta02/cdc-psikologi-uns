<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class SeedMahasiswasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:mahasiswas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with 10 mahasiswa records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding 10 mahasiswa records using direct SQL...');
        
        try {
            // Check if users table exists
            if (!Schema::hasTable('users')) {
                $this->error('The users table does not exist. Please run migrations first.');
                return Command::FAILURE;
            }
            
            // Check if mahasiswas table exists
            if (!Schema::hasTable('mahasiswas')) {
                $this->error('The mahasiswas table does not exist. Please run migrations first.');
                return Command::FAILURE;
            }
            
            // Create users directly with SQL
            for ($i = 1; $i <= 10; $i++) {
                // Create a user
                $userId = DB::table('users')->insertGetId([
                    'name' => 'Mahasiswa ' . $i,
                    'email' => 'mahasiswa' . $i . '@example.com',
                    'password' => Hash::make('password'),
                    'username' => 'mahasiswa' . $i,
                    'level' => 'student',
                    'verified' => 1,
                    'approved' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Create a mahasiswa
                $angkatan = rand(2018, 2024);
                $nim = $angkatan . str_pad($i, 5, '0', STR_PAD_LEFT);
                
                DB::table('mahasiswas')->insert([
                    'nim' => $nim,
                    'angkatan' => (string)$angkatan,
                    'jurusan' => '01',
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->info("Created mahasiswa {$i} with NIM {$nim}");
            }

            $this->info('Mahasiswa seeding completed successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to seed mahasiswas: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
