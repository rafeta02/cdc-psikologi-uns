@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.careerConfidenceTest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.career-confidence-tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.user') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.result') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->result->test_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.r_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->r_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.r_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->r_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.r_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->r_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.r_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->r_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.i_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->i_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.i_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->i_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.i_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->i_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.i_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->i_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.a_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->a_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.a_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->a_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.a_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->a_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.a_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->a_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.s_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->s_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.s_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->s_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.s_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->s_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.s_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->s_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.e_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->e_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.e_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->e_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.e_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->e_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.e_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->e_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.c_1') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->c_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.c_2') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->c_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.c_3') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->c_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.careerConfidenceTest.fields.c_4') }}
                        </th>
                        <td>
                            {{ $careerConfidenceTest->c_4 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.career-confidence-tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection