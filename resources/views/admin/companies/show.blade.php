@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.company.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.name') }}
                        </th>
                        <td>
                            {{ $company->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.description') }}
                        </th>
                        <td>
                            {!! $company->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.image') }}
                        </th>
                        <td>
                            @if($company->image)
                                <a href="{{ $company->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $company->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.address') }}
                        </th>
                        <td>
                            {{ $company->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.telephone') }}
                        </th>
                        <td>
                            {{ $company->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.email') }}
                        </th>
                        <td>
                            {{ $company->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.website') }}
                        </th>
                        <td>
                            {{ $company->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.scale') }}
                        </th>
                        <td>
                            {{ App\Models\Company::SCALE_SELECT[$company->scale] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.number_of_employee') }}
                        </th>
                        <td>
                            {{ $company->number_of_employee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.ownership') }}
                        </th>
                        <td>
                            {{ App\Models\Company::OWNERSHIP_SELECT[$company->ownership] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.industry') }}
                        </th>
                        <td>
                            {{ $company->industry->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.location') }}
                        </th>
                        <td>
                            {{ $company->location }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection