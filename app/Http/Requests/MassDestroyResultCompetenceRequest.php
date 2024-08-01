<?php

namespace App\Http\Requests;

use App\Models\ResultCompetence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyResultCompetenceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_competence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:result_competences,id',
        ];
    }
}
