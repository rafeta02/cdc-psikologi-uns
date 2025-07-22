<?php

namespace Database\Seeders;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Database\Seeder;

class RegenciesTableSeeder extends Seeder
{
    public function run()
    {
        // Get some provinces to associate with regencies
        $jateng = Province::where('code', '33')->first();
        $jabar = Province::where('code', '32')->first();
        $jatim = Province::where('code', '35')->first();
        $yogya = Province::where('code', '34')->first();
        $jakarta = Province::where('code', '31')->first();

        $regencies = [
            // Jawa Tengah
            ['code' => '3371', 'name' => 'Surakarta', 'province_id' => $jateng->id],
            ['code' => '3372', 'name' => 'Salatiga', 'province_id' => $jateng->id],
            ['code' => '3373', 'name' => 'Semarang', 'province_id' => $jateng->id],
            ['code' => '3374', 'name' => 'Tegal', 'province_id' => $jateng->id],
            ['code' => '3375', 'name' => 'Pekalongan', 'province_id' => $jateng->id],
            ['code' => '3376', 'name' => 'Magelang', 'province_id' => $jateng->id],

            // Jawa Barat  
            ['code' => '3271', 'name' => 'Bandung', 'province_id' => $jabar->id],
            ['code' => '3272', 'name' => 'Bekasi', 'province_id' => $jabar->id],
            ['code' => '3273', 'name' => 'Depok', 'province_id' => $jabar->id],
            ['code' => '3274', 'name' => 'Cimahi', 'province_id' => $jabar->id],
            ['code' => '3275', 'name' => 'Bogor', 'province_id' => $jabar->id],

            // Jawa Timur
            ['code' => '3571', 'name' => 'Surabaya', 'province_id' => $jatim->id],
            ['code' => '3572', 'name' => 'Malang', 'province_id' => $jatim->id],
            ['code' => '3573', 'name' => 'Kediri', 'province_id' => $jatim->id],
            ['code' => '3574', 'name' => 'Madiun', 'province_id' => $jatim->id],

            // DI Yogyakarta
            ['code' => '3471', 'name' => 'Yogyakarta', 'province_id' => $yogya->id],
            ['code' => '3401', 'name' => 'Kulon Progo', 'province_id' => $yogya->id],
            ['code' => '3402', 'name' => 'Bantul', 'province_id' => $yogya->id],
            ['code' => '3403', 'name' => 'Gunung Kidul', 'province_id' => $yogya->id],
            ['code' => '3404', 'name' => 'Sleman', 'province_id' => $yogya->id],

            // DKI Jakarta
            ['code' => '3171', 'name' => 'Jakarta Selatan', 'province_id' => $jakarta->id],
            ['code' => '3172', 'name' => 'Jakarta Timur', 'province_id' => $jakarta->id],
            ['code' => '3173', 'name' => 'Jakarta Pusat', 'province_id' => $jakarta->id],
            ['code' => '3174', 'name' => 'Jakarta Barat', 'province_id' => $jakarta->id],
            ['code' => '3175', 'name' => 'Jakarta Utara', 'province_id' => $jakarta->id],
        ];

        foreach ($regencies as $regency) {
            Regency::create($regency);
        }
    }
} 