<?php

namespace App\Http\Requests;

use App\Models\PrestasiMahasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrestasiMahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prestasi_mahasiswa_create');
    }

    public function rules()
    {
        return [
            'skim' => [
                'required',
            ],
            'tingkat' => [
                'required',
            ],
            'nama_kegiatan' => [
                'string',
                'required',
            ],
            'tanggal_awal' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tanggal_akhir' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'jumlah_peserta' => [
                'required',
            ],
            'perolehan_juara' => [
                'required',
            ],
            'nama_penyelenggara' => [
                'string',
                'required',
            ],
            'tempat_penyelenggara' => [
                'string',
                'required',
            ],
            'url_publikasi' => [
                'string',
                'nullable',
            ],
            'surat_tugas' => [
                'array',
            ],
            'sertifikat' => [
                'array',
            ],
            'foto_dokumentasi' => [
                'array',
            ],
            'bukti_sipsmart' => [
                'array',
            ],
            'no_wa' => [
                'string',
                'required',
            ],
        ];
    }
}
