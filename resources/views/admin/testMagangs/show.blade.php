@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testMagang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.test-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.mahasiswa') }}
                        </th>
                        <td>
                            {{ $testMagang->mahasiswa->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.magang') }}
                        </th>
                        <td>
                            {{ $testMagang->magang->instansi ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TestMagang::TYPE_SELECT[$testMagang->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.result') }}
                        </th>
                        <td>
                            {{ $testMagang->result }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.q_1') }}
                        </th>
                        <td>
                            {{ $testMagang->q_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.q_2') }}
                        </th>
                        <td>
                            {{ $testMagang->q_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.q_3') }}
                        </th>
                        <td>
                            {{ $testMagang->q_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testMagang.fields.q_4') }}
                        </th>
                        <td>
                            {{ $testMagang->q_4 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.test-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection