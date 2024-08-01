<?php

namespace App\Http\Requests;

use App\Models\TracerAlumnu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTracerAlumnuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tracer_alumnu_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'telephone' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'angkatan' => [
                'required',
            ],
            'nama_instansi' => [
                'string',
                'nullable',
            ],
            'jabatan_instansi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
