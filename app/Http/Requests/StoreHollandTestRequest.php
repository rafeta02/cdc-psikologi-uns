<?php

namespace App\Http\Requests;

use App\Models\HollandTest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHollandTestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('holland_test_create');
    }

    public function rules()
    {
        return [
            'r_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'r_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'i_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'a_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            's_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'e_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_1' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_3' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_4' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_5' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_6' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_7' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'c_8' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
