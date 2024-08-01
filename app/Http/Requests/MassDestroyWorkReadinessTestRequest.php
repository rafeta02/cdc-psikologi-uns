<?php

namespace App\Http\Requests;

use App\Models\WorkReadinessTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkReadinessTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('work_readiness_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:work_readiness_tests,id',
        ];
    }
}
