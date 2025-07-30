<?php

namespace App\Http\Requests;

use App\Models\MahasiswaMagang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMahasiswaMagangRequest extends FormRequest
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
            'approval_notes' => [
                'string',
                'nullable',
            ],
            'verification_notes' => [
                'string',
                'nullable',
            ],
            'pretest' => [
                'nullable',
                'integer',
                'min:0',
                'max:100',
            ],
            'posttest' => [
                'nullable',
                'integer',
                'min:0',
                'max:100',
            ],
            'form_penilaian_pembimbing_lapangan' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:10240',
            ],
            'form_penilaian_dosen_pembimbing' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:10240',
            ],
            'khs' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],
            'krs' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],
            'form_persetujuan_dosen_pa' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240',
            ],
            'surat_persetujuan_rekognisi' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240',
            ],
            'logbook_mbkm' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:10240',
            ],
        ];
    }
} 