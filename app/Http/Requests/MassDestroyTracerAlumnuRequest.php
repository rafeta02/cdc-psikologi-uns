<?php

namespace App\Http\Requests;

use App\Models\TracerAlumnu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTracerAlumnuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tracer_alumnu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tracer_alumnus,id',
        ];
    }
}
