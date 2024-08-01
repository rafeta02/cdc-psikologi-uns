<?php

namespace App\Http\Requests;

use App\Models\PrestasiMahasiswaDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPrestasiMahasiswaDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:prestasi_mahasiswa_details,id',
        ];
    }
}
