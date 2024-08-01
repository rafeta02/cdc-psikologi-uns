<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswaDetail extends Model
{
    use HasFactory;

    public $table = 'prestasi_mahasiswa_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nim',
        'nama',
        'prestasi_mahasiswa_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function prestasi_mahasiswa()
    {
        return $this->belongsTo(PrestasiMahasiswa::class, 'prestasi_mahasiswa_id');
    }
}
