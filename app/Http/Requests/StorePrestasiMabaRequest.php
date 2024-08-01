<?php

namespace App\Http\Requests;

use App\Models\PrestasiMaba;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrestasiMabaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prestasi_maba_create');
    }

    public function rules()
    {
        return [
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
            'bukti_kegiatan' => [
                'array',
            ],
        ];
    }
}
