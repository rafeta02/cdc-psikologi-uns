<?php

namespace App\Http\Requests;

use App\Models\MonitoringMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMonitoringMagangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('monitoring_magang_create');
    }

    public function rules()
    {
        return [
            'mahasiswa_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'magang_id' => [
                'required',
                'integer',
                'exists:mahasiswa_magangs,id',
            ],
            'pembimbing' => [
                'string',
                'nullable',
            ],
            'tanggal' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tempat' => [
                'string',
                'nullable',
            ],
            'hasil' => [
                'string',
                'nullable',
            ],
            'bukti' => [
                'array',
            ],
        ];
    }
}
