<?php

namespace App\Http\Requests;

use App\Models\Magang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMagangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('magang_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'open_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'close_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'needs' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'filled' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
