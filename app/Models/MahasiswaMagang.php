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

    protected $casts = [
        'pretest_completed_at' => 'datetime',
        'posttest_completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
        'khs',
        'krs',
        'form_persetujuan_dosen_pa',
        'surat_persetujuan_rekognisi',
        'logbook_mbkm',
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

    /**
     * Generate custom file name with NIM and unique ID
     */
    public function generateCustomFileName($originalName, $collectionName)
    {
        $nim = $this->nim ?? 'unknown';
        $studentName = $this->nama ?? 'unknown';
        $timestamp = now()->format('Y-m-d_H-i-s');
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        
        // Create a more descriptive file name
        $documentType = $this->getDocumentTypeLabel($collectionName);
        $cleanStudentName = preg_replace('/[^a-zA-Z0-9\s]/', '', $studentName);
        $cleanStudentName = str_replace(' ', '_', trim($cleanStudentName));
        
        return $nim . '_' . $cleanStudentName . '_' . $documentType . '_' . $timestamp . '.' . $extension;
    }

    /**
     * Get human-readable document type label
     */
    private function getDocumentTypeLabel($collectionName)
    {
        $labels = [
            'proposal_magang' => 'Proposal_Magang',
            'surat_tugas' => 'Surat_Tugas',
            'berkas_instansi' => 'Berkas_Instansi',
            'laporan_akhir' => 'Laporan_Akhir',
            'presensi' => 'Presensi',
            'sertifikat' => 'Sertifikat',
            'form_penilaian_pembimbing_lapangan' => 'Form_Penilaian_Pembimbing_Lapangan',
            'form_penilaian_dosen_pembimbing' => 'Form_Penilaian_Dosen_Pembimbing',
            'berita_acara_seminar' => 'Berita_Acara_Seminar',
            'presensi_kehadiran_seminar' => 'Presensi_Kehadiran_Seminar',
            'notulen_pertanyaan' => 'Notulen_Pertanyaan',
            'tanda_bukti_penyerahan_laporan' => 'Tanda_Bukti_Penyerahan_Laporan',
            'berkas_magang' => 'Berkas_Magang',
            'khs' => 'KHS',
            'krs' => 'KRS',
            'form_persetujuan_dosen_pa' => 'Form_Persetujuan_Dosen_PA',
            'surat_persetujuan_rekognisi' => 'Surat_Persetujuan_Rekognisi',
            'logbook_mbkm' => 'Logbook_MBKM',
        ];
        
        return $labels[$collectionName] ?? $collectionName;
    }



    /**
     * Register media collections with custom naming
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('proposal_magang')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('surat_tugas')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('berkas_instansi')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('laporan_akhir')
            ->useDisk('public');

        $this->addMediaCollection('presensi')
            ->useDisk('public');

        $this->addMediaCollection('sertifikat')
            ->useDisk('public');

        $this->addMediaCollection('form_penilaian_pembimbing_lapangan')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('form_penilaian_dosen_pembimbing')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('berita_acara_seminar')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('presensi_kehadiran_seminar')
            ->useDisk('public');

        $this->addMediaCollection('notulen_pertanyaan')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('tanda_bukti_penyerahan_laporan')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('berkas_magang')
            ->useDisk('public');

        $this->addMediaCollection('khs')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('krs')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('form_persetujuan_dosen_pa')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('surat_persetujuan_rekognisi')
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('logbook_mbkm')
            ->useDisk('public')
            ->singleFile();
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

    public function getKhsAttribute()
    {
        return $this->getMedia('khs')->last();
    }

    public function getKrsAttribute()
    {
        return $this->getMedia('krs')->last();
    }

    public function getFormPersetujuanDosenPaAttribute()
    {
        return $this->getMedia('form_persetujuan_dosen_pa')->last();
    }

    public function getSuratPersetujuanRekognisiAttribute()
    {
        return $this->getMedia('surat_persetujuan_rekognisi')->last();
    }

    public function getLogbookMbkmAttribute()
    {
        return $this->getMedia('logbook_mbkm')->last();
    }

    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }

    public function dospem()
    {
        return $this->belongsTo(Dospem::class, 'dosen_pembimbing');
    }

    public function monitorings()
    {
        return $this->hasMany(MonitoringMagang::class, 'magang_id');
    }

    /**
     * Helper method to safely format dates
     */
    public function formatDate($field, $format = 'd M Y, H:i')
    {
        if (!$this->$field) {
            return 'N/A';
        }
        
        try {
            if (is_string($this->$field)) {
                return \Carbon\Carbon::parse($this->$field)->format($format);
            }
            
            return $this->$field->format($format);
        } catch (\Exception $e) {
            return 'Invalid Date';
        }
    }

    /**
     * Check if user can create a new application
     */
    public static function canUserApply($userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        $activeApplication = self::where('mahasiswa_id', $userId)
            ->whereIn('approve', ['PENDING', 'APPROVED'])
            ->first();
            
        return !$activeApplication;
    }

    /**
     * Get user's current active application
     */
    public static function getUserActiveApplication($userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        return self::where('mahasiswa_id', $userId)
            ->whereIn('approve', ['PENDING', 'APPROVED'])
            ->first();
    }

    /**
     * Get user's application status message
     */
    public static function getUserApplicationStatusMessage($userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        $activeApplication = self::getUserActiveApplication($userId);
        
        if (!$activeApplication) {
            return [
                'can_apply' => true,
                'message' => 'You can submit a new internship application.',
                'type' => 'success'
            ];
        }
        
        $statusMessages = [
            'PENDING' => [
                'can_apply' => false,
                'message' => 'You have a pending internship application. Please wait for admin approval.',
                'type' => 'warning'
            ],
            'APPROVED' => [
                'can_apply' => false,
                'message' => 'You have an approved internship application. Complete your internship before applying for a new one.',
                'type' => 'info'
            ]
        ];
        
        return $statusMessages[$activeApplication->approve] ?? [
            'can_apply' => true,
            'message' => 'You can submit a new internship application.',
            'type' => 'success'
        ];
    }

    /**
     * Check if final documents can be uploaded
     */
    public function canUploadFinalDocuments()
    {
        // Must be approved
        if ($this->approve !== 'APPROVED') {
            return [
                'can_upload' => false,
                'reason' => 'Application must be approved first',
                'type' => 'warning'
            ];
        }

        // Must have completed posttest
        if (!$this->posttest || !$this->posttest_completed_at) {
            return [
                'can_upload' => false,
                'reason' => 'You must complete the posttest before uploading final documents',
                'type' => 'warning'
            ];
        }

        // Must have minimum monitoring reports
        $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $this->id)->count();
        if ($monitoringCount < 1) {
            return [
                'can_upload' => false,
                'reason' => "You need at least 1 monitoring report. Current: {$monitoringCount}/1",
                'type' => 'warning'
            ];
        }

        return [
            'can_upload' => true,
            'reason' => 'All requirements met. You can upload final documents.',
            'type' => 'success'
        ];
    }
}
