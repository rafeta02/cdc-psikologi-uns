<?php

namespace App\Http\Requests;

use App\Models\ResultAssessment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyResultAssessmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_assessment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:result_assessments,id',
        ];
    }
}
