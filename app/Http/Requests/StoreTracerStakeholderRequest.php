<?php

namespace App\Http\Requests;

use App\Models\TracerStakeholder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTracerStakeholderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tracer_stakeholder_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'nama_instansi' => [
                'string',
                'required',
            ],
            'nama_alumni' => [
                'string',
                'required',
            ],
            'tahun_lulus' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'waktu_tunggu' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
