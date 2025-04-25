@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.testMagang.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.test-magangs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="mahasiswa_id">{{ trans('cruds.testMagang.fields.mahasiswa') }}</label>
                            <select class="form-control select2" name="mahasiswa_id" id="mahasiswa_id">
                                @foreach($mahasiswas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('mahasiswa_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mahasiswa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mahasiswa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.mahasiswa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="magang_id">{{ trans('cruds.testMagang.fields.magang') }}</label>
                            <select class="form-control select2" name="magang_id" id="magang_id">
                                @foreach($magangs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('magang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('magang'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('magang') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.magang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.testMagang.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TestMagang::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="result">{{ trans('cruds.testMagang.fields.result') }}</label>
                            <input class="form-control" type="text" name="result" id="result" value="{{ old('result', '') }}">
                            @if($errors->has('result'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('result') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.result_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="q_1">{{ trans('cruds.testMagang.fields.q_1') }}</label>
                            <input class="form-control" type="number" name="q_1" id="q_1" value="{{ old('q_1', '') }}" step="1">
                            @if($errors->has('q_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('q_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.q_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="q_2">{{ trans('cruds.testMagang.fields.q_2') }}</label>
                            <input class="form-control" type="text" name="q_2" id="q_2" value="{{ old('q_2', '') }}">
                            @if($errors->has('q_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('q_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.q_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="q_3">{{ trans('cruds.testMagang.fields.q_3') }}</label>
                            <input class="form-control" type="number" name="q_3" id="q_3" value="{{ old('q_3', '') }}" step="1">
                            @if($errors->has('q_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('q_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.q_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="q_4">{{ trans('cruds.testMagang.fields.q_4') }}</label>
                            <input class="form-control" type="number" name="q_4" id="q_4" value="{{ old('q_4', '') }}" step="1">
                            @if($errors->has('q_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('q_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.testMagang.fields.q_4_helper') }}</span>
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