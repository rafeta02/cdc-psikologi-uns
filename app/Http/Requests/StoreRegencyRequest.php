<?php

namespace App\Http\Requests;

use App\Models\Regency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRegencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('regency_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:regencies',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
