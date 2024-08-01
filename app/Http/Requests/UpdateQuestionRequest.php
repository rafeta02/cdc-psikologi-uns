<?php

namespace App\Http\Requests;

use App\Models\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_edit');
    }

    public function rules()
    {
        return [
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'code' => [
                'string',
                'required',
            ],
            'text' => [
                'string',
                'required',
            ],
            'text_en' => [
                'string',
                'nullable',
            ],
        ];
    }
}
