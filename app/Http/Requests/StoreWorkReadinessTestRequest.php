<?php

namespace App\Http\Requests;

use App\Models\WorkReadinessTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkReadinessTestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_readiness_test_create');
    }

    public function rules()
    {
        return [
            'cbs_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_9' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cbs_10' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cms_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cms_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cms_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cms_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cs_9' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'fs_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'fs_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'fs_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ics_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ics_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ics_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ics_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ics_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'its_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'its_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'its_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ls_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ls_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ls_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ls_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ls_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sms_9' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sts_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sts_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sts_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'sts_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tps_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tps_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tps_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tps_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
