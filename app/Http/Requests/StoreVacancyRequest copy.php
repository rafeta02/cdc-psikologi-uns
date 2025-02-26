<?php

namespace App\Http\Requests;

use App\Models\Vacancy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVacancyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vacancy_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'open_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'close_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'education.*' => [
                'integer',
            ],
            'education' => [
                'array',
            ],
            'departments.*' => [
                'integer',
            ],
            'departments' => [
                'array',
            ],
            'minimum_gpa' => [
                'numeric',
                'min:0',
                'max:4',
            ],
            'locations.*' => [
                'integer',
            ],
            'locations' => [
                'array',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
        ];
    }
}
