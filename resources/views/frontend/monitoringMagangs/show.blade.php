@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.monitoringMagang.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.monitoring-magangs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.mahasiswa') }}
                                    </th>
                                    <td>
                                        {{ $monitoringMagang->mahasiswa->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.magang') }}
                                    </th>
                                    <td>
                                        {{ $monitoringMagang->magang->instansi ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.pembimbing') }}
                                    </th>
                                    <td>
                                        {{ $monitoringMagang->dospem->nama ?? $monitoringMagang->pembimbing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.tanggal') }}
                                    </th>
                                    <td>
                                        {{ $monitoringMagang->tanggal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.tempat') }}
                                    </th>
                                    <td>
                                        {{ $monitoringMagang->tempat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.hasil') }}
                                    </th>
                                    <td>
                                        {!! $monitoringMagang->hasil !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.bukti') }}
                                    </th>
                                    <td>
                                        @foreach($monitoringMagang->bukti as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.monitoring-magangs.index') }}">
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