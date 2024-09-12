<?php

namespace App\Exports;

use App\Models\TracerAlumnu;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TracerAlumnuExport implements FromQuery, WithMapping, WithHeadings
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
        return TracerAlumnu::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->with(['kota_asal', 'kota_domisili']);
    }

    public function map($tracerAlumnu): array
    {
        return [
            $tracerAlumnu->nim,
            $tracerAlumnu->nama,
            $tracerAlumnu->telephone,
            $tracerAlumnu->email,
            $tracerAlumnu->angkatan,
            $tracerAlumnu->kota_asal->name ?? '',
            $tracerAlumnu->kota_domisili->name ?? '',
            TracerAlumnu::PARTISIPASI_RADIO[$tracerAlumnu->partisipasi] ?? '',
            TracerAlumnu::KESIBUKAN_SELECT[$tracerAlumnu->kesibukan] ?? '',
            $tracerAlumnu->nama_instansi,
            $tracerAlumnu->jabatan_instansi,
            TracerAlumnu::PENDAPATAN_RADIO[$tracerAlumnu->pendapatan] ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Telephone',
            'Email',
            'Angkatan',
            'Kota Asal',
            'Kota Domisili',
            'Partisipasi',
            'Kesibukan',
            'Nama Instansi',
            'Jabatan Instansi',
            'Pendapatan',
        ];
    }
}

