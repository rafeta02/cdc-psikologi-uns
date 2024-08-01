<?php

namespace App\Http\Requests;

use App\Models\KategoriPrestasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKategoriPrestasiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kategori_prestasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kategori_prestasis,id',
        ];
    }
}
