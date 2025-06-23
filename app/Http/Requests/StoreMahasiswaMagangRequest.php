<?php

namespace App\Http\Requests;

use App\Models\MahasiswaMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMahasiswaMagangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nim' => [
                'string',
                'nullable',
                'max:20',
            ],
            'nama' => [
                'string',
                'nullable',
                'max:255',
            ],
            'semester' => [
                'nullable',
                'integer',
                'min:1',
                'max:12',
            ],
            'type' => [
                'nullable',
                'in:' . implode(',', array_keys(MahasiswaMagang::TYPE_SELECT)),
            ],
            'bidang' => [
                'nullable',
                'in:' . implode(',', array_keys(MahasiswaMagang::BIDANG_SELECT)),
            ],
            'magang_id' => [
                'nullable',
                'integer',
                'exists:magangs,id',
            ],
            'instansi' => [
                'string',
                'nullable',
                'max:255',
            ],
            'alamat_instansi' => [
                'string',
                'nullable',
            ],
            'dosen_pembimbing' => [
                'string',
                'nullable',
                'max:255',
            ],
            'berkas_magang' => [
                'array',
                'nullable',
            ],
            'berkas_magang.*' => [
                'nullable',
            ],
            'mahasiswa_id' => [
                'nullable',
                'integer',
                'exists:users,id',
            ],
            'approve' => [
                'nullable',
                'in:' . implode(',', array_keys(MahasiswaMagang::APPROVE_SELECT)),
            ],
            'verified' => [
                'nullable',
                'in:' . implode(',', array_keys(MahasiswaMagang::VERIFIED_SELECT)),
            ],
        ];
    }
} 