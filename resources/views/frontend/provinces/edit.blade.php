@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.province.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.provinces.update", [$province->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.province.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $province->code) }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.province.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $province->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.name_helper') }}</span>
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