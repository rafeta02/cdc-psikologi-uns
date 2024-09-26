<?php

namespace App\Exports;

use App\Models\PrestasiMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PrestasiMahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    // Constructor to receive the date range
    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        // Fetching records based on created_at within the date range
        return PrestasiMahasiswa::with(['kategori', 'pesertas'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get();
    }

    public function headings(): array
    {
        return [
            'SKIM',
            'Tingkat',
            'Nama Kegiatan',
            'Kategori',
            'Tanggal Awal',
            'Tanggal Akhir',
            'Jumlah Peserta',
            'Perolehan Juara',
            'Nama Penyelenggara',
            'Tempat Penyelenggara',
            'Keikutsertaan',
            'Peserta',
            'URL Publikasi',
            'No WA',
            'Surat Tugas',
            'Sertifikat',
            'Foto Dokumentasi',
            'Surat Tugas Pembimbing',
            'Bukti Sipsmart',
        ];
    }

    public function map($prestasi): array
    {
        $pesertas = $prestasi->pesertas->map(function($peserta) {
            return $peserta->nim . ' - ' . $peserta->nama;
        })->implode('; '); // or "\n" for newline

        return [
            PrestasiMahasiswa::SKIM_RADIO[$prestasi->skim] ?? '',
            PrestasiMahasiswa::TINGKAT_RADIO[$prestasi->tingkat] ?? '',
            $prestasi->nama_kegiatan,
            $prestasi->kategori->name ?? '',
            $prestasi->tanggal_awal,
            $prestasi->tanggal_akhir,
            PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$prestasi->jumlah_peserta] ?? '',
            PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasi->perolehan_juara] ?? '',
            $prestasi->nama_penyelenggara,
            $prestasi->tempat_penyelenggara,
            PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasi->keikutsertaan] ?? '',
            $pesertas,
            $prestasi->url_publikasi,
            $prestasi->no_wa,
            $this->getMediaUrls($prestasi->getMedia('surat_tugas')),
            $this->getMediaUrls($prestasi->getMedia('sertifikat')),
            $this->getMediaUrls($prestasi->getMedia('foto_dokumentasi')),
            $this->getMediaUrls($prestasi->getMedia('surat_tugas_pembimbing')),
            $this->getMediaUrls($prestasi->getMedia('bukti_sipsmart')),
        ];
    }

    protected function getMediaUrls($mediaCollection)
    {
        // Join the URLs with a semicolon if there are multiple files
        return $mediaCollection->map(function($media) {
            return $media->getUrl();
        })->implode('; ');
    }

}
