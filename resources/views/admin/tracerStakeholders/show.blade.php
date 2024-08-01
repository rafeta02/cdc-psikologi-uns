@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tracerStakeholder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tracer-stakeholders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.nama') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.nama_instansi') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->nama_instansi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.nama_alumni') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->nama_alumni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.tahun_lulus') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->tahun_lulus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.waktu_tunggu') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->waktu_tunggu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.tingkat_instansi') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::TINGKAT_INSTANSI_RADIO[$tracerStakeholder->tingkat_instansi] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kesesuaian_bidan') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KESESUAIAN_BIDAN_RADIO[$tracerStakeholder->kesesuaian_bidan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_integritas') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_INTEGRITAS_RADIO[$tracerStakeholder->kompetensi_integritas] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_profesionalisme') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_PROFESIONALISME_RADIO[$tracerStakeholder->kompetensi_profesionalisme] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_inggris') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_INGGRIS_RADIO[$tracerStakeholder->kompetensi_inggris] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_it') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_IT_RADIO[$tracerStakeholder->kompetensi_it] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_komunikasi') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_KOMUNIKASI_RADIO[$tracerStakeholder->kompetensi_komunikasi] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_kerjasama') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_KERJASAMA_RADIO[$tracerStakeholder->kompetensi_kerjasama] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kompetensi_pengembangan') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KOMPETENSI_PENGEMBANGAN_RADIO[$tracerStakeholder->kompetensi_pengembangan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.kepuasan_alumni') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->kepuasan_alumni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.saran') }}
                        </th>
                        <td>
                            {{ $tracerStakeholder->saran }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.ketersediaan_campus_hiring') }}
                        </th>
                        <td>
                            {{ App\Models\TracerStakeholder::KETERSEDIAAN_CAMPUS_HIRING_RADIO[$tracerStakeholder->ketersediaan_campus_hiring] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tracerStakeholder.fields.tanda_tangan') }}
                        </th>
                        <td>
                            @if($tracerStakeholder->tanda_tangan)
                                <a href="{{ $tracerStakeholder->tanda_tangan->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tracer-stakeholders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection