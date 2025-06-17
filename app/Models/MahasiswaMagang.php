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

class MahasiswaMagang extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'mahasiswa_magangs';

    public const TYPE_SELECT = [
        'KMM'  => 'KMM',
        'MBKM' => 'MBKM',
    ];

    protected $dates = [
        'pretest_completed_at',
        'posttest_completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const APPROVE_SELECT = [
        'APPROVED' => 'APPROVED',
        'REJECTED' => 'REJECTED',
        'PENDING'  => 'PENDING',
    ];

    public const VERIFIED_SELECT = [
        'APPROVED' => 'APPROVED',
        'REJECTED' => 'REJECTED',
        'PENDING'  => 'PENDING',
    ];

    public const BIDANG_SELECT = [
        'klinis'     => 'Klinis',
        'sosial'     => 'Sosial',
        'industri'   => 'Industri',
        'pendidikan' => 'Pendidikan',
        'lainnya'    => 'Lainnya',
    ];

    protected $appends = [
        'proposal_magang',
        'surat_tugas',
        'berkas_instansi',
        'laporan_akhir',
        'presensi',
        'sertifikat',
        'form_penilaian_pembimbing_lapangan',
        'form_penilaian_dosen_pembimbing',
        'berita_acara_seminar',
        'presensi_kehadiran_seminar',
        'notulen_pertanyaan',
        'tanda_bukti_penyerahan_laporan',
        'berkas_magang',
    ];

    protected $fillable = [
        'mahasiswa_id',
        'nim',
        'nama',
        'semester',
        'type',
        'bidang',
        'magang_id',
        'company_id',
        'instansi',
        'alamat_instansi',
        'approve',
        'approval_notes',
        'approved_by_id',
        'pretest',
        'pretest_completed_at',
        'posttest',
        'posttest_completed_at',
        'dosen_pembimbing',
        'verified',
        'verification_notes',
        'verified_by_id',
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

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function getProposalMagangAttribute()
    {
        return $this->getMedia('proposal_magang')->last();
    }

    public function getSuratTugasAttribute()
    {
        return $this->getMedia('surat_tugas')->last();
    }

    public function getBerkasInstansiAttribute()
    {
        return $this->getMedia('berkas_instansi')->last();
    }

    public function getLaporanAkhirAttribute()
    {
        return $this->getMedia('laporan_akhir');
    }

    public function getPresensiAttribute()
    {
        return $this->getMedia('presensi');
    }

    public function getSertifikatAttribute()
    {
        return $this->getMedia('sertifikat');
    }

    public function getFormPenilaianPembimbingLapanganAttribute()
    {
        return $this->getMedia('form_penilaian_pembimbing_lapangan')->last();
    }

    public function getFormPenilaianDosenPembimbingAttribute()
    {
        return $this->getMedia('form_penilaian_dosen_pembimbing')->last();
    }

    public function getBeritaAcaraSeminarAttribute()
    {
        return $this->getMedia('berita_acara_seminar')->last();
    }

    public function getPresensiKehadiranSeminarAttribute()
    {
        return $this->getMedia('presensi_kehadiran_seminar');
    }

    public function getNotulenPertanyaanAttribute()
    {
        return $this->getMedia('notulen_pertanyaan')->last();
    }

    public function getTandaBuktiPenyerahanLaporanAttribute()
    {
        return $this->getMedia('tanda_bukti_penyerahan_laporan')->last();
    }

    public function getBerkasMagangAttribute()
    {
        return $this->getMedia('berkas_magang');
    }

    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }

    public function monitorings()
    {
        return $this->hasMany(MonitoringMagang::class, 'magang_id');
    }
}
