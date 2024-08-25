@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vacancy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vacancies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.name') }}
                        </th>
                        <td>
                            {{ $vacancy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.slug') }}
                        </th>
                        <td>
                            {{ $vacancy->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.company') }}
                        </th>
                        <td>
                            {{ $vacancy->company->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.description') }}
                        </th>
                        <td>
                            {!! $vacancy->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Vacancy::TYPE_SELECT[$vacancy->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.open_date') }}
                        </th>
                        <td>
                            {{ $vacancy->open_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.close_date') }}
                        </th>
                        <td>
                            {{ $vacancy->close_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.persyaratan_umum') }}
                        </th>
                        <td>
                            {!! $vacancy->persyaratan_umum !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.persyaratan_khusus') }}
                        </th>
                        <td>
                            {!! $vacancy->persyaratan_khusus !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.registration') }}
                        </th>
                        <td>
                            {!! $vacancy->registration !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.job_description') }}
                        </th>
                        <td>
                            {!! $vacancy->job_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.education') }}
                        </th>
                        <td>
                            @foreach($vacancy->education as $key => $education)
                                <span class="label label-info">{{ $education->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.department') }}
                        </th>
                        <td>
                            @foreach($vacancy->departments as $key => $department)
                                <span class="label label-info">{{ $department->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.minimum_gpa') }}
                        </th>
                        <td>
                            {{ $vacancy->minimum_gpa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.position') }}
                        </th>
                        <td>
                            {{ $vacancy->position->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.industry') }}
                        </th>
                        <td>
                            {{ $vacancy->industry->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.location') }}
                        </th>
                        <td>
                            {{ $vacancy->location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacancy.fields.featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $vacancy->featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vacancies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection