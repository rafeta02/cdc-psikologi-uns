<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'name' => 'Psikologi Klinis',
                'description' => 'Departemen yang fokus pada diagnosis dan pengobatan gangguan mental',
                'featured' => 1
            ],
            [
                'name' => 'Psikologi Pendidikan',
                'description' => 'Departemen yang fokus pada psikologi dalam konteks pendidikan',
                'featured' => 1
            ],
            [
                'name' => 'Psikologi Sosial',
                'description' => 'Departemen yang mempelajari perilaku individu dalam konteks sosial',
                'featured' => 1
            ],
            [
                'name' => 'Psikologi Perkembangan',
                'description' => 'Departemen yang mempelajari perkembangan manusia sepanjang hidup',
                'featured' => 0
            ],
            [
                'name' => 'Psikologi Industri dan Organisasi',
                'description' => 'Departemen yang fokus pada psikologi di tempat kerja',
                'featured' => 1
            ],
            [
                'name' => 'Psikologi Kognitif',
                'description' => 'Departemen yang mempelajari proses mental seperti persepsi, memori, dan pikiran',
                'featured' => 0
            ],
            [
                'name' => 'Neuropsikologi',
                'description' => 'Departemen yang mempelajari hubungan antara otak dan perilaku',
                'featured' => 0
            ],
            [
                'name' => 'Psikologi Eksperimen',
                'description' => 'Departemen yang fokus pada penelitian eksperimental dalam psikologi',
                'featured' => 0
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
} 