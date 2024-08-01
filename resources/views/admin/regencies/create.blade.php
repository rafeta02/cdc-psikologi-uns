@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.regency.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regencies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.regency.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.regency.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province_id">{{ trans('cruds.regency.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id">
                    @foreach($provinces as $id => $entry)
                        <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.province_helper') }}</span>
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