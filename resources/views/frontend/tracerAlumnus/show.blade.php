@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3>Data Tracer Alumni</h3>
        </div>

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.tracerAlumnu.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.tracer-alumnus.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%">
                                        {{ trans('cruds.tracerAlumnu.fields.nama') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.telephone') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->telephone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.angkatan') }}
                                    </th>
                                    <td>
                                        {{ App\Models\TracerAlumnu::ANGKATAN_SELECT[$tracerAlumnu->angkatan] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.kota_asal') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->kota_asal->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.kota_domisili') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->kota_domisili->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.partisipasi') }}
                                    </th>
                                    <td>
                                        {{ App\Models\TracerAlumnu::PARTISIPASI_RADIO[$tracerAlumnu->partisipasi] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.kesibukan') }}
                                    </th>
                                    <td>
                                        {{ App\Models\TracerAlumnu::KESIBUKAN_SELECT[$tracerAlumnu->kesibukan] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.nama_instansi') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->nama_instansi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.jabatan_instansi') }}
                                    </th>
                                    <td>
                                        {{ $tracerAlumnu->jabatan_instansi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tracerAlumnu.fields.pendapatan') }}
                                    </th>
                                    <td>
                                        {{ App\Models\TracerAlumnu::PENDAPATAN_RADIO[$tracerAlumnu->pendapatan] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.tracer-alumnus.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
