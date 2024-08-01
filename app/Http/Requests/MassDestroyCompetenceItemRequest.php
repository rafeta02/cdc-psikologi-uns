<?php

namespace App\Http\Requests;

use App\Models\CompetenceItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompetenceItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('competence_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:competence_items,id',
        ];
    }
}
