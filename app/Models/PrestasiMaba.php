<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PrestasiMaba extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'prestasi_mabas';

    protected $appends = [
        'bukti_kegiatan',
    ];

    public const KEIKUTSERTAAN_RADIO = [
        'individu' => 'Individu',
        'kelompok' => 'Tim/Kelompok',
    ];

    public const JUMLAH_PESERTA_RADIO = [
        '>10' => '>= 10 Perguruan Tinggi',
        '<10' => '<10 Perguruan Tinggi',
    ];

    protected $dates = [
        'tanggal_awal',
        'tanggal_akhir',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TINGKAT_RADIO = [
        'internasional' => 'Internasional (min. 2 negara)',
        'nasional'      => 'Nasional (min. 4 provinsi)',
        'regional'      => 'Provinsi/ Regional (1-3 provinsi)',
    ];

    protected $fillable = [
        'tingkat',
        'nama_kegiatan',
        'kategori_id',
        'tanggal_awal',
        'tanggal_akhir',
        'jumlah_peserta',
        'perolehan_juara',
        'nama_penyelenggara',
        'tempat_penyelenggara',
        'keikutsertaan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PEROLEHAN_JUARA_SELECT = [
        'juara_1'   => 'Juara 1',
        'juara_2'   => 'Juara 2',
        'juara_3'   => 'Juara 3',
        'harapan_1' => 'Harapan 1',
        'harapan_2' => 'Harapan 2',
        'harapan_3' => 'Harapan 3',
        'apresiasi' => 'Apresiasi kejuaraan/Penghargaan tambahan/Juara umum',
        'peserta'   => 'peserta',
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

    public function kategori()
    {
        return $this->belongsTo(KategoriPrestasi::class, 'kategori_id');
    }

    public function getTanggalAwalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalAwalAttribute($value)
    {
        $this->attributes['tanggal_awal'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTanggalAkhirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalAkhirAttribute($value)
    {
        $this->attributes['tanggal_akhir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBuktiKegiatanAttribute()
    {
        return $this->getMedia('bukti_kegiatan');
    }
}
