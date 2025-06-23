<?php

namespace App\Exports;

use App\Models\MahasiswaMagang;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class MahasiswaMagangExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $dateField;

    public function __construct($startDate = null, $endDate = null, $dateField = 'created_at')
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->dateField = $dateField;
    }

    public function collection()
    {
        $query = MahasiswaMagang::with([
            'mahasiswa', 
            'magang', 
            'company',
            'approved_by', 
            'verified_by',
            'monitorings'
        ]);

        // Apply date filters if provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween($this->dateField, [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);
        } elseif ($this->startDate) {
            $query->where($this->dateField, '>=', Carbon::parse($this->startDate)->startOfDay());
        } elseif ($this->endDate) {
            $query->where($this->dateField, '<=', Carbon::parse($this->endDate)->endOfDay());
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama Mahasiswa',
            'Username Mahasiswa',
            'Email Mahasiswa',
            'Nama (Override)',
            'Semester',
            'Type',
            'Bidang',
            'Nama Magang',
            'Company',
            'Instansi',
            'Alamat Instansi',
            'Status Approval',
            'Catatan Approval',
            'Approved By',
            'Tanggal Approval',
            'Dosen Pembimbing',
            'Pretest Status',
            'Tanggal Pretest',
            'Posttest Status',
            'Tanggal Posttest',
            'Status Verifikasi',
            'Catatan Verifikasi',
            'Verified By',
            'Tanggal Verifikasi',
            'Jumlah Monitoring Reports',
            'Current Phase',
            'Status Completion',
            'Proposal Magang',
            'Proposal Magang',
            'Surat Tugas',
            'Surat Tugas',
            'Berkas Instansi',
            'Berkas Instansi',
            'Laporan Akhir',
            'Laporan Akhir',
            'Presensi',
            'Presensi',
            'Sertifikat',
            'Sertifikat',
            'Form Penilaian Pembimbing Lapangan',
            'Form Penilaian Pembimbing Lapangan',
            'Form Penilaian Dosen Pembimbing',
            'Form Penilaian Dosen Pembimbing',
            'Berita Acara Seminar',
            'Berita Acara Seminar',
            'Presensi Kehadiran Seminar',
            'Presensi Kehadiran Seminar',
            'Notulen Pertanyaan',
            'Notulen Pertanyaan',
            'Tanda Bukti Penyerahan Laporan',
            'Tanda Bukti Penyerahan Laporan',
            'Berkas Magang',
            'Berkas Magang',
            'Created At',
            'Updated At',
        ];
    }

    public function map($mahasiswaMagang): array
    {
        // Determine current phase
        $currentPhase = $this->determineCurrentPhase($mahasiswaMagang);
        $completionStatus = $this->getCompletionStatus($mahasiswaMagang);
        
                 return [
             $mahasiswaMagang->id,
             $mahasiswaMagang->nim ?? '',
             $mahasiswaMagang->mahasiswa->name ?? '',
             $mahasiswaMagang->mahasiswa->name ?? '',
             $mahasiswaMagang->mahasiswa->email ?? '',
             $mahasiswaMagang->nama ?? '',
             $mahasiswaMagang->semester ?? '',
             $mahasiswaMagang->type ? MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] : '',
             $mahasiswaMagang->bidang ? MahasiswaMagang::BIDANG_SELECT[$mahasiswaMagang->bidang] : '',
             $mahasiswaMagang->magang->name ?? '',
             $mahasiswaMagang->company->name ?? '',
             $mahasiswaMagang->instansi ?? '',
             $mahasiswaMagang->alamat_instansi ?? '',
             $mahasiswaMagang->approve ? MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] : '',
             $mahasiswaMagang->approval_notes ?? '',
             $mahasiswaMagang->approved_by->name ?? '',
                          $mahasiswaMagang->approved_by && $mahasiswaMagang->approve === 'APPROVED' ? $this->formatDate($mahasiswaMagang->updated_at) : '',
             $mahasiswaMagang->dosen_pembimbing ?? '',
             $mahasiswaMagang->pretest ? 'Completed' : 'Not Completed',
             $this->formatDate($mahasiswaMagang->pretest_completed_at),
             $mahasiswaMagang->posttest ? 'Completed' : 'Not Completed',
             $this->formatDate($mahasiswaMagang->posttest_completed_at),
             $mahasiswaMagang->verified ? MahasiswaMagang::VERIFIED_SELECT[$mahasiswaMagang->verified] : '',
             $mahasiswaMagang->verification_notes ?? '',
             $mahasiswaMagang->verified_by->name ?? '',
             $mahasiswaMagang->verified_by && $mahasiswaMagang->verified === 'APPROVED' ? $this->formatDate($mahasiswaMagang->updated_at) : '',
            $mahasiswaMagang->monitorings->count() ?? 0,
            $currentPhase,
            $completionStatus,
            $mahasiswaMagang->proposal_magang ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('proposal_magang')),     
            $mahasiswaMagang->surat_tugas ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('surat_tugas')),
            $mahasiswaMagang->berkas_instansi ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('berkas_instansi')),
            $mahasiswaMagang->laporan_akhir->count() > 0 ? 'Uploaded (' . $mahasiswaMagang->laporan_akhir->count() . ' files)' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('laporan_akhir')),
            $mahasiswaMagang->presensi->count() > 0 ? 'Uploaded (' . $mahasiswaMagang->presensi->count() . ' files)' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('presensi')),
            $mahasiswaMagang->sertifikat->count() > 0 ? 'Uploaded (' . $mahasiswaMagang->sertifikat->count() . ' files)' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('sertifikat')),
            $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('form_penilaian_pembimbing_lapangan')),
            $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('form_penilaian_dosen_pembimbing')),
            $mahasiswaMagang->berita_acara_seminar ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('berita_acara_seminar')),
            $mahasiswaMagang->presensi_kehadiran_seminar->count() > 0 ? 'Uploaded (' . $mahasiswaMagang->presensi_kehadiran_seminar->count() . ' files)' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('presensi_kehadiran_seminar')),
            $mahasiswaMagang->notulen_pertanyaan ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('notulen_pertanyaan')),
            $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'Uploaded' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('tanda_bukti_penyerahan_laporan')),
            $mahasiswaMagang->berkas_magang->count() > 0 ? 'Uploaded (' . $mahasiswaMagang->berkas_magang->count() . ' files)' : 'Not Uploaded',
            $this->getMediaUrls($mahasiswaMagang->getMedia('berkas_magang')),
             $this->formatDate($mahasiswaMagang->created_at),
             $this->formatDate($mahasiswaMagang->updated_at),
        ];
    }

    private function determineCurrentPhase($row)
    {
        // Phase 1: Application Review
        if ($row->approve === 'PENDING') {
            return 'Phase 1: Application Review';
        }
        
        if ($row->approve === 'REJECTED') {
            return 'Application Rejected';
        }
        
        // Phase 2: Pre-test & Document Submission
        if ($row->approve === 'APPROVED' && !$row->pretest) {
            return 'Phase 2: Pre-test Required';
        }
        
        // Phase 3: Internship Period (Monitoring)
        if ($row->approve === 'APPROVED' && $row->pretest && !$row->posttest) {
            // Check monitoring requirements
            $monitoringCount = $row->monitorings->count();
            
            if ($monitoringCount < 5) {
                return 'Phase 3: Internship Period (' . $monitoringCount . '/5 reports)';
            } else {
                // Check if 1 month has passed since pretest
                $pretestDate = $row->pretest_completed_at;
                if (!$pretestDate) {
                    // Fallback to test record if timestamp not available
                    $pretestRecord = \App\Models\TestMagang::where('magang_id', $row->id)
                        ->where('type', 'PRETEST')
                        ->first();
                    if ($pretestRecord) {
                        $pretestDate = $pretestRecord->created_at;
                    }
                }
                
                if ($pretestDate) {
                    // Ensure $pretestDate is a Carbon instance before calling copy()
                    if (is_string($pretestDate)) {
                        $pretestDate = \Carbon\Carbon::parse($pretestDate);
                    }
                    
                    if ($pretestDate instanceof \Carbon\Carbon) {
                        $oneMonthLater = $pretestDate->copy()->addMonth();
                        $now = now();
                        
                        if ($now->gte($oneMonthLater)) {
                            return 'Phase 3: Ready for Post-test';
                        } else {
                            $daysRemaining = $now->diffInDays($oneMonthLater);
                            return 'Phase 3: Post-test in ' . $daysRemaining . ' days';
                        }
                    } else {
                        return 'Phase 3: Internship Period';
                    }
                } else {
                    return 'Phase 3: Internship Period';
                }
            }
        }
        
        // Phase 4: Completion Phase
        if ($row->approve === 'APPROVED' && $row->pretest && $row->posttest) {
            if ($row->verified === 'PENDING') {
                return 'Phase 4: Document Verification';
            } elseif ($row->verified === 'REJECTED') {
                return 'Phase 4: Document Revision Required';
            } elseif ($row->verified === 'APPROVED') {
                return 'Completed Successfully';
            }
        }
        
        // Default fallback
        return 'Status Unknown';
    }

    private function getCompletionStatus($row)
    {
        if ($row->verified === 'APPROVED') {
            return 'COMPLETED';
        }
        
        if ($row->approve === 'REJECTED') {
            return 'REJECTED';
        }
        
        return 'IN PROGRESS';
    }

    /**
     * Safely format date to string
     */
    private function formatDate($date)
    {
        if (!$date) {
            return '';
        }
        
        if (is_string($date)) {
            try {
                return Carbon::parse($date)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                return $date;
            }
        }
        
        if ($date instanceof Carbon) {
            return $date->format('Y-m-d H:i:s');
        }
        
        return '';
    }

    protected function getMediaUrls($mediaCollection)
    {
        // Join the URLs with a semicolon if there are multiple files
        return $mediaCollection->map(function($media) {
            return $media->getUrl();
        })->implode('; ');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Auto-size columns
                foreach (range('A', 'AV') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
                
                // Style the header row
                $event->sheet->getDelegate()->getStyle('A1:AV1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => '4472C4'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
} 