<?php

namespace App\Http\Requests;

use App\Models\CompetenceItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompetenceItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competence_item_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'source' => [
                'string',
                'required',
            ],
        ];
    }
}
