@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mahasiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mahasiswa.fields.nim') }}
                        </th>
                        <td>
                            {{ $mahasiswa->nim }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mahasiswa.fields.angkatan') }}
                        </th>
                        <td>
                            {{ $mahasiswa->angkatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mahasiswa.fields.jurusan') }}
                        </th>
                        <td>
                            {{ App\Models\Mahasiswa::JURUSAN_SELECT[$mahasiswa->jurusan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mahasiswa.fields.user') }}
                        </th>
                        <td>
                            {{ $mahasiswa->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection