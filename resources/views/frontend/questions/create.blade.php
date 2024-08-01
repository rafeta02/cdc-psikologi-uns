@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.questions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="number">{{ trans('cruds.question.fields.number') }}</label>
                            <input class="form-control" type="number" name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                            @if($errors->has('number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.question.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="text">{{ trans('cruds.question.fields.text') }}</label>
                            <input class="form-control" type="text" name="text" id="text" value="{{ old('text', '') }}" required>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.text_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="text_en">{{ trans('cruds.question.fields.text_en') }}</label>
                            <input class="form-control" type="text" name="text_en" id="text_en" value="{{ old('text_en', '') }}">
                            @if($errors->has('text_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.text_en_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.question.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.type_helper') }}</span>
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