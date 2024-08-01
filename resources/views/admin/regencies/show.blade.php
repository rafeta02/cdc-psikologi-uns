@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.regency.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.code') }}
                        </th>
                        <td>
                            {{ $regency->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.name') }}
                        </th>
                        <td>
                            {{ $regency->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.province') }}
                        </th>
                        <td>
                            {{ $regency->province->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection