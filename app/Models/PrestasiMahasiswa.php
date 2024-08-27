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

class PrestasiMahasiswa extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'prestasi_mahasiswas';

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

    protected $appends = [
        'surat_tugas',
        'sertifikat',
        'foto_dokumentasi',
        'surat_tugas_pembimbing',
        'bukti_sipsmart',
    ];

    public const TINGKAT_RADIO = [
        'internasional' => 'Internasional (min. 2 negara)',
        'nasional'      => 'Nasional (min. 4 provinsi)',
        'regional'      => 'Provinsi/ Regional (1-3 provinsi)',
    ];

    public const SKIM_RADIO = [
        'lomba'     => 'Pendelegasian Kompetisi Mandiri (untuk ajang perlombaan)',
        'non_lomba' => 'Rekognisi Non Lomba (untuk juri, pemakalah, narasumber seminar, penulis buku/jurnal min sinta2,pameran, HKI, dll)',
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

    protected $fillable = [
        'user_id',
        'skim',
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
        'url_publikasi',
        'no_wa',
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

    public function prestasiMahasiswaPrestasiMahasiswaDetails()
    {
        return $this->hasMany(PrestasiMahasiswaDetail::class, 'prestasi_mahasiswa_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function getSuratTugasAttribute()
    {
        return $this->getMedia('surat_tugas');
    }

    public function getSertifikatAttribute()
    {
        return $this->getMedia('sertifikat');
    }

    public function getFotoDokumentasiAttribute()
    {
        $files = $this->getMedia('foto_dokumentasi');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getSuratTugasPembimbingAttribute()
    {
        return $this->getMedia('surat_tugas_pembimbing')->last();
    }

    public function getBuktiSipsmartAttribute()
    {
        $files = $this->getMedia('bukti_sipsmart');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
