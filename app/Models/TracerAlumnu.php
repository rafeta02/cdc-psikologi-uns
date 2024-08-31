<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TracerAlumnu extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'tracer_alumnus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PARTISIPASI_RADIO = [
        'tertarik' => 'Tertarik',
        'tidak'    => 'Tidak Tertarik',
    ];

    public const ANGKATAN_SELECT = [
        '2018' => '2018',
        '2019' => '2019',
        '2020' => '2020',
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023',
        '2024' => '2024',
    ];

    public const KESIBUKAN_SELECT = [
        'bekerja'       => 'Bekerja (Fulltime / Part time)',
        'tidak_bekerja' => 'Tidak Bekerja tetapi sedang mencari pekerjaan',
        'sekolah'       => 'Melanjutkan Pendidikan',
        'wiraswasta'    => 'Wiraswasta',
    ];

    public const PENDAPATAN_RADIO = [
        '3k'  => '< 3.000.000',
        '10k' => '3.000.000 - 10.000.000',
        '20k' => '10.000.001 - 20.000.000',
        '30k' => '20.000.001 - 30.000.000',
        '40k' => '30.000.001 - 40.000.000',
        '50k' => '> 40.000.000',
    ];

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'telephone',
        'email',
        'angkatan',
        'kota_asal_id',
        'kota_domisili_id',
        'partisipasi',
        'kesibukan',
        'nama_instansi',
        'jabatan_instansi',
        'pendapatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kota_asal()
    {
        return $this->belongsTo(Regency::class, 'kota_asal_id');
    }

    public function kota_domisili()
    {
        return $this->belongsTo(Regency::class, 'kota_domisili_id');
    }
}
