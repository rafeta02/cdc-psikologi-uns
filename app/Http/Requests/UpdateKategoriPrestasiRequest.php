<?php

namespace App\Http\Requests;

use App\Models\KategoriPrestasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKategoriPrestasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kategori_prestasi_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
