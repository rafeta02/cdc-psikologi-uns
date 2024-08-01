<?php

namespace App\Http\Requests;

use App\Models\ResultAssessment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResultAssessmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('result_assessment_create');
    }

    public function rules()
    {
        return [
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
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
