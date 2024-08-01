<?php

namespace App\Http\Requests;

use App\Models\Vacancy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVacancyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vacancy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vacancies,id',
        ];
    }
}
