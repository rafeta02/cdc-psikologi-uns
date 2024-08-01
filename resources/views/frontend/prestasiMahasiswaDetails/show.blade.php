@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.prestasiMahasiswaDetail.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.prestasi-mahasiswa-details.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswaDetail.fields.nim') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswaDetail->nim }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswaDetail.fields.nama') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswaDetail->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswaDetail.fields.prestasi_mahasiswa') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswaDetail->prestasi_mahasiswa->nama_kegiatan ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.prestasi-mahasiswa-details.index') }}">
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