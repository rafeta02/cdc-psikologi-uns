<?php

namespace App\Http\Requests;

use App\Models\PrestasiMahasiswaDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePrestasiMahasiswaDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prestasi_mahasiswa_detail_edit');
    }

    public function rules()
    {
        return [
            'nim' => [
                'string',
                'required',
            ],
            'nama' => [
                'string',
                'required',
            ],
            'prestasi_mahasiswa_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
