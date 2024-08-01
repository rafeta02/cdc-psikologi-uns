<?php

namespace App\Http\Requests;

use App\Models\TracerStakeholder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTracerStakeholderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tracer_stakeholder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tracer_stakeholders,id',
        ];
    }
}
