<?php

namespace App\Http\Requests;

use App\Models\Province;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProvinceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('province_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:provinces,code,' . request()->route('province')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
