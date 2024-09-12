<?php

namespace App\Http\Requests;

use App\Models\VacancyTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVacancyTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vacancy_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vacancy_tags,id',
        ];
    }
}
