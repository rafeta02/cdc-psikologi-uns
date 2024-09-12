<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TracerStakeholder extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'tracer_stakeholders';

    protected $appends = [
        'tanda_tangan',
    ];

    public const KOMPETENSI_IT_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const KOMPETENSI_INGGRIS_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    public const KOMPETENSI_KERJASAMA_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    public const KOMPETENSI_KOMUNIKASI_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    public const KOMPETENSI_PENGEMBANGAN_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    public const KOMPETENSI_PROFESIONALISME_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    public const KETERSEDIAAN_CAMPUS_HIRING_RADIO = [
        'ya'    => 'Ya',
        'tidak' => 'Tidak',
    ];

    public const KESESUAIAN_BIDANG_RADIO = [
        'tinggi' => 'Tinggi',
        'sedang' => 'Sedang',
        'rendah' => 'Rendah',
    ];

    public const TINGKAT_INSTANSI_RADIO = [
        'lokal'         => 'Lokal',
        'nasional'       => 'Nasional',
        'internasional' => 'Internasional',
    ];

    public const KOMPETENSI_INTEGRITAS_RADIO = [
        'sangat_baik' => 'Sangat Baik',
        'baik'        => 'Baik',
        'cukup'       => 'Cukup',
        'kurang'      => 'Kurang',
    ];

    protected $fillable = [
        'nama',
        'nama_instansi',
        'nama_alumni',
        'tahun_lulus',
        'waktu_tunggu',
        'tingkat_instansi',
        'kesesuaian_bidang',
        'kompetensi_integritas',
        'kompetensi_profesionalisme',
        'kompetensi_inggris',
        'kompetensi_it',
        'kompetensi_komunikasi',
        'kompetensi_kerjasama',
        'kompetensi_pengembangan',
        'kepuasan_alumni',
        'saran',
        'ketersediaan_campus_hiring',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getTandaTanganAttribute()
    {
        return $this->getMedia('tanda_tangan')->last();
    }
}
