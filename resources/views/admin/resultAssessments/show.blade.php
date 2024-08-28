@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.resultAssessment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.result-assessments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.user') }}
                        </th>
                        <td>
                            {{ $resultAssessment->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.initial') }}
                        </th>
                        <td>
                            {{ $resultAssessment->initial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.age') }}
                        </th>
                        <td>
                            {{ $resultAssessment->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\ResultAssessment::GENDER_RADIO[$resultAssessment->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.field') }}
                        </th>
                        <td>
                            {{ $resultAssessment->field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.test_name') }}
                        </th>
                        <td>
                            {{ App\Models\ResultAssessment::TEST_NAME_SELECT[$resultAssessment->test_name] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.result_text') }}
                        </th>
                        <td>
                            {{ $resultAssessment->result_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resultAssessment.fields.result_description') }}
                        </th>
                        <td>
                            {{ $resultAssessment->result_description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.result-assessments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection