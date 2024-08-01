@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.question.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" id="number" value="{{ old('number', $question->number) }}" step="1" required>
                @if($errors->has('number'))
                    <span class="text-danger">{{ $errors->first('number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.question.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $question->code) }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="text">{{ trans('cruds.question.fields.text') }}</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', $question->text) }}" required>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text_en">{{ trans('cruds.question.fields.text_en') }}</label>
                <input class="form-control {{ $errors->has('text_en') ? 'is-invalid' : '' }}" type="text" name="text_en" id="text_en" value="{{ old('text_en', $question->text_en) }}">
                @if($errors->has('text_en'))
                    <span class="text-danger">{{ $errors->first('text_en') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.text_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.question.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $question->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
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



@endsection