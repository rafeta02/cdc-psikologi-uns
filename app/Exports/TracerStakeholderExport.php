<?php

namespace App\Exports;

use App\Models\TracerStakeholder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TracerStakeholderExport implements FromQuery, WithMapping, WithHeadings
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
        return TracerStakeholder::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function map($tracerStakeholder): array
    {
        return [
            $tracerStakeholder->nama,
            $tracerStakeholder->nama_instansi,
            $tracerStakeholder->nama_alumni,
            $tracerStakeholder->tahun_lulus,
            $tracerStakeholder->waktu_tunggu,
            TracerStakeholder::TINGKAT_INSTANSI_RADIO[$tracerStakeholder->tingkat_instansi] ?? '',
            TracerStakeholder::KESESUAIAN_BIDANG_RADIO[$tracerStakeholder->kesesuaian_bidang] ?? '',
            TracerStakeholder::KOMPETENSI_INTEGRITAS_RADIO[$tracerStakeholder->kompetensi_integritas] ?? '',
            TracerStakeholder::KOMPETENSI_PROFESIONALISME_RADIO[$tracerStakeholder->kompetensi_profesionalisme] ?? '',
            TracerStakeholder::KOMPETENSI_INGGRIS_RADIO[$tracerStakeholder->kompetensi_inggris] ?? '',
            TracerStakeholder::KOMPETENSI_IT_RADIO[$tracerStakeholder->kompetensi_it] ?? '',
            TracerStakeholder::KOMPETENSI_KOMUNIKASI_RADIO[$tracerStakeholder->kompetensi_komunikasi] ?? '',
            TracerStakeholder::KOMPETENSI_KERJASAMA_RADIO[$tracerStakeholder->kompetensi_kerjasama] ?? '',
            TracerStakeholder::KOMPETENSI_PENGEMBANGAN_RADIO[$tracerStakeholder->kompetensi_pengembangan] ?? '',
            $tracerStakeholder->kepuasan_alumni,
            $tracerStakeholder->saran,
            TracerStakeholder::KETERSEDIAAN_CAMPUS_HIRING_RADIO[$tracerStakeholder->ketersediaan_campus_hiring] ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Nama Instansi',
            'Nama Alumni',
            'Tahun Lulus',
            'Waktu Tunggu',
            'Tingkat Instansi',
            'Kesesuaian Bidang',
            'Kompetensi Integritas',
            'Kompetensi Profesionalisme',
            'Kompetensi Bahasa Inggris',
            'Kompetensi IT',
            'Kompetensi Komunikasi',
            'Kompetensi Kerjasama',
            'Kompetensi Pengembangan',
            'Kepuasan Alumni',
            'Saran',
            'Ketersediaan Campus Hiring',
        ];
    }
}

