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
            'bukti' => [
                'array',
            ],
        ];
    }
}
