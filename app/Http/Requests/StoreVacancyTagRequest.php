<?php

namespace App\Http\Requests;

use App\Models\VacancyTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVacancyTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vacancy_tag_create');
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
