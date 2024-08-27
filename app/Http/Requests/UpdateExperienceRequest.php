<?php

namespace App\Http\Requests;

use App\Models\Experience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experience_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
