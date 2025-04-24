@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.magang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.name') }}
                        </th>
                        <td>
                            {{ $magang->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.slug') }}
                        </th>
                        <td>
                            {{ $magang->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.company') }}
                        </th>
                        <td>
                            {{ $magang->company->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.description') }}
                        </th>
                        <td>
                            {!! $magang->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Magang::TYPE_SELECT[$magang->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.open_date') }}
                        </th>
                        <td>
                            {{ $magang->open_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.close_date_exist') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $magang->close_date_exist ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.close_date') }}
                        </th>
                        <td>
                            {{ $magang->close_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.persyaratan') }}
                        </th>
                        <td>
                            {!! $magang->persyaratan !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.registrasi') }}
                        </th>
                        <td>
                            {!! $magang->registrasi !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.needs') }}
                        </th>
                        <td>
                            {{ $magang->needs }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.filled') }}
                        </th>
                        <td>
                            {{ $magang->filled }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.magang.fields.featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $magang->featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection