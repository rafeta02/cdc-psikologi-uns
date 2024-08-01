@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.question.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.questions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.number') }}
                                    </th>
                                    <td>
                                        {{ $question->number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $question->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.text') }}
                                    </th>
                                    <td>
                                        {{ $question->text }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.text_en') }}
                                    </th>
                                    <td>
                                        {{ $question->text_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Question::TYPE_SELECT[$question->type] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.questions.index') }}">
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