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
            'initial' => [
                'string',
                'required',
            ],
            'age' => [
                'required',
                'integer',
                'min:0',
                'max:120',
            ],
            'field' => [
                'string',
                'required',
            ],
        ];
    }
}
