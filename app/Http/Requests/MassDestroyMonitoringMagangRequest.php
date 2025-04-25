<?php

namespace App\Http\Requests;

use App\Models\MonitoringMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMonitoringMagangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('monitoring_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:monitoring_magangs,id',
        ];
    }
}
