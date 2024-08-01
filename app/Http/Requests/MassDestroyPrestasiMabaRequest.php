<?php

namespace App\Http\Requests;

use App\Models\PrestasiMaba;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPrestasiMabaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prestasi_maba_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:prestasi_mabas,id',
        ];
    }
}
