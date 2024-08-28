<?php

namespace App\Http\Requests;

use App\Models\ResultCompetence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResultCompetenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('result_competence_create');
    }

    public function rules()
    {
        return [];
    }
}
