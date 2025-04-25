@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.testMagang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.test-magangs.update", [$testMagang->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="mahasiswa_id">{{ trans('cruds.testMagang.fields.mahasiswa') }}</label>
                <select class="form-control select2 {{ $errors->has('mahasiswa') ? 'is-invalid' : '' }}" name="mahasiswa_id" id="mahasiswa_id">
                    @foreach($mahasiswas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('mahasiswa_id') ? old('mahasiswa_id') : $testMagang->mahasiswa->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mahasiswa'))
                    <span class="text-danger">{{ $errors->first('mahasiswa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="magang_id">{{ trans('cruds.testMagang.fields.magang') }}</label>
                <select class="form-control select2 {{ $errors->has('magang') ? 'is-invalid' : '' }}" name="magang_id" id="magang_id">
                    @foreach($magangs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('magang_id') ? old('magang_id') : $testMagang->magang->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('magang'))
                    <span class="text-danger">{{ $errors->first('magang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.magang_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.testMagang.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TestMagang::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $testMagang->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="result">{{ trans('cruds.testMagang.fields.result') }}</label>
                <input class="form-control {{ $errors->has('result') ? 'is-invalid' : '' }}" type="text" name="result" id="result" value="{{ old('result', $testMagang->result) }}">
                @if($errors->has('result'))
                    <span class="text-danger">{{ $errors->first('result') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.result_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="q_1">{{ trans('cruds.testMagang.fields.q_1') }}</label>
                <input class="form-control {{ $errors->has('q_1') ? 'is-invalid' : '' }}" type="number" name="q_1" id="q_1" value="{{ old('q_1', $testMagang->q_1) }}" step="1">
                @if($errors->has('q_1'))
                    <span class="text-danger">{{ $errors->first('q_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.q_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="q_2">{{ trans('cruds.testMagang.fields.q_2') }}</label>
                <input class="form-control {{ $errors->has('q_2') ? 'is-invalid' : '' }}" type="text" name="q_2" id="q_2" value="{{ old('q_2', $testMagang->q_2) }}">
                @if($errors->has('q_2'))
                    <span class="text-danger">{{ $errors->first('q_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.q_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="q_3">{{ trans('cruds.testMagang.fields.q_3') }}</label>
                <input class="form-control {{ $errors->has('q_3') ? 'is-invalid' : '' }}" type="number" name="q_3" id="q_3" value="{{ old('q_3', $testMagang->q_3) }}" step="1">
                @if($errors->has('q_3'))
                    <span class="text-danger">{{ $errors->first('q_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testMagang.fields.q_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="q_4">{{ trans('cruds.testMagang.fields.q_4') }}</label>
                <input class="form-control {{ $errors->has('q_4') ? 'is-invalid' : '' }}" type="number" name="q_4" id="q_4" value="{{ old('q_4', $testMagang->q_4) }}" step="1">
                @if($errors->has('q_4'))
                    <span class="text-danger">{{ $errors->first('q_4') }}</span>
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



@endsection