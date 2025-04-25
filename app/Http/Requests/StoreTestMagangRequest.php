<?php

namespace App\Http\Requests;

use App\Models\TestMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestMagangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_magang_create');
    }

    public function rules()
    {
        return [
            'result' => [
                'string',
                'nullable',
            ],
            'q_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'q_2' => [
                'string',
                'nullable',
            ],
            'q_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'q_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
