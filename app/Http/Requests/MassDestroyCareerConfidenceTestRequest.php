<?php

namespace App\Http\Requests;

use App\Models\CareerConfidenceTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCareerConfidenceTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('career_confidence_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:career_confidence_tests,id',
        ];
    }
}
