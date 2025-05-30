<?php

namespace App\Http\Requests;

use App\Models\Contest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contest_create');
    }

    public function rules()
    {
        return [
            'judul' => [
                'string',
                'nullable',
            ],
            'penyelenggara' => [
                'string',
                'nullable',
            ],
            'tanggal' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
