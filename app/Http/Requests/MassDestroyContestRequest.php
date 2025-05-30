<?php

namespace App\Http\Requests;

use App\Models\Contest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:contests,id',
        ];
    }
}
