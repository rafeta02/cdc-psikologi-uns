<?php

namespace App\Http\Requests;

use App\Models\Competence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompetenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competence_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
