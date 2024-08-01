<?php

namespace App\Http\Requests;

use App\Models\Regency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('regency_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:regencies,code,' . request()->route('regency')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
