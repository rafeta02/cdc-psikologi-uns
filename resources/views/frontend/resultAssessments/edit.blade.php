@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.resultAssessment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.result-assessments.update", [$resultAssessment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="users">{{ trans('cruds.resultAssessment.fields.user') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="users[]" id="users" multiple required>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $resultAssessment->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="initial">{{ trans('cruds.resultAssessment.fields.initial') }}</label>
                            <input class="form-control" type="text" name="initial" id="initial" value="{{ old('initial', $resultAssessment->initial) }}">
                            @if($errors->has('initial'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('initial') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.initial_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="age">{{ trans('cruds.resultAssessment.fields.age') }}</label>
                            <input class="form-control" type="number" name="age" id="age" value="{{ old('age', $resultAssessment->age) }}" step="1">
                            @if($errors->has('age'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('age') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.age_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.resultAssessment.fields.gender') }}</label>
                            @foreach(App\Models\ResultAssessment::GENDER_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $resultAssessment->gender) === (string) $key ? 'checked' : '' }}>
                                    <label for="gender_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="field">{{ trans('cruds.resultAssessment.fields.field') }}</label>
                            <input class="form-control" type="text" name="field" id="field" value="{{ old('field', $resultAssessment->field) }}">
                            @if($errors->has('field'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('field') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.field_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.resultAssessment.fields.test_name') }}</label>
                            <select class="form-control" name="test_name" id="test_name" required>
                                <option value disabled {{ old('test_name', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ResultAssessment::TEST_NAME_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('test_name', $resultAssessment->test_name) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('test_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('test_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.test_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="result_text">{{ trans('cruds.resultAssessment.fields.result_text') }}</label>
                            <input class="form-control" type="text" name="result_text" id="result_text" value="{{ old('result_text', $resultAssessment->result_text) }}">
                            @if($errors->has('result_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('result_text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.result_text_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="result_description">{{ trans('cruds.resultAssessment.fields.result_description') }}</label>
                            <textarea class="form-control" name="result_description" id="result_description">{{ old('result_description', $resultAssessment->result_description) }}</textarea>
                            @if($errors->has('result_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('result_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.resultAssessment.fields.result_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection