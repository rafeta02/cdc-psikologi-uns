<?php

namespace App\Http\Requests;

use App\Models\ResultAssessment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateResultAssessmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('result_assessment_edit');
    }

    public function rules()
    {
        return [
            'initial' => [
                'string',
                'nullable',
            ],
            'age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field' => [
                'string',
                'nullable',
            ],
            'test_name' => [
                'required',
            ],
            'result_text' => [
                'string',
                'nullable',
            ],
        ];
    }
}
