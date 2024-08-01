<?php

namespace App\Http\Requests;

use App\Models\HollandTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHollandTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('holland_test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:holland_tests,id',
        ];
    }
}
