@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.hollandTest.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.holland-tests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.result') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->result->test_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.r_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->r_8 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.i_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->i_8 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.a_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->a_8 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.s_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->s_8 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.e_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->e_8 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_1') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_2') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_3') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_4') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_4 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_5') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_5 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_6') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_6 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_7') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_7 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hollandTest.fields.c_8') }}
                                    </th>
                                    <td>
                                        {{ $hollandTest->c_8 }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.holland-tests.index') }}">
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