<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Province;
use App\Models\Regency;

class RegencyImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $province = Province::where('code', $row['province'])->first();
            Regency::create([
                'code' => $row['code'],
                'name' => $row['name'],
                'province_id' => $province->id
            ]);
        }
    }
}
