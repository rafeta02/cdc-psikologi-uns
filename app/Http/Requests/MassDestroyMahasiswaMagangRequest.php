<?php

namespace App\Http\Requests;

use App\Models\MahasiswaMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMahasiswaMagangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mahasiswa_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mahasiswa_magangs,id',
        ];
    }
} 