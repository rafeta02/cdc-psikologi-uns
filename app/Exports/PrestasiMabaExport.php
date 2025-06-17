<?php

namespace App\Exports;

use App\Models\PrestasiMaba;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class PrestasiMabaExport implements FromQuery, WithMapping, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return PrestasiMaba::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function map($prestasiMaba): array
    {
        return [
            $prestasiMaba->user->name,
            $prestasiMaba->user->identity_number ?? '-',
            $prestasiMaba->nama_kegiatan,
            $prestasiMaba->tingkat ? PrestasiMaba::TINGKAT_RADIO[$prestasiMaba->tingkat] : '',
            $prestasiMaba->kategori->name ?? '',
            $prestasiMaba->tanggal_awal ? Carbon::parse($prestasiMaba->tanggal_awal)->format('Y-m-d') : '',
            $prestasiMaba->tanggal_akhir ? Carbon::parse($prestasiMaba->tanggal_akhir)->format('Y-m-d') : '',
            $prestasiMaba->jumlah_peserta ? PrestasiMaba::JUMLAH_PESERTA_RADIO[$prestasiMaba->jumlah_peserta] : '',
            $prestasiMaba->perolehan_juara ? PrestasiMaba::PEROLEHAN_JUARA_SELECT[$prestasiMaba->perolehan_juara] : '',
            $prestasiMaba->nama_penyelenggara,
            $prestasiMaba->tempat_penyelenggara,
            $prestasiMaba->keikutsertaan ? PrestasiMaba::KEIKUTSERTAAN_RADIO[$prestasiMaba->keikutsertaan] : '',
            $this->getFiles($prestasiMaba->getBuktiKegiatanAttribute()),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'NIM Mahasiswa',
            'Nama Kegiatan',
            'Tingkat',
            'Kategori',
            'Tanggal Awal',
            'Tanggal Akhir',
            'Jumlah Peserta',
            'Perolehan Juara',
            'Nama Penyelenggara',
            'Tempat Penyelenggara',
            'Keikutsertaan',
            'Bukti Kegiatan',
        ];
    }

    private function getFiles($files)
    {
        if ($files->isEmpty()) {
            return '';
        }

        return $files->map(function ($file) {
            return $file->getUrl();
        })->implode('; ');
    }
}

