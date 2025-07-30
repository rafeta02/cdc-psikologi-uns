<?php

namespace App\Http\Requests;

use App\Models\Dospem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDospemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dospem_create');
    }

    public function rules()
    {
        return [
            'nip' => [
                'string',
                'nullable',
            ],
            'nama' => [
                'string',
                'nullable',
            ],
            'whatshapp' => [
                'string',
                'nullable',
            ],
        ];
    }
}
