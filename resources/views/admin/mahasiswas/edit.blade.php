@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mahasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mahasiswas.update", [$mahasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nim">{{ trans('cruds.mahasiswa.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}">
                @if($errors->has('nim'))
                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="angkatan">{{ trans('cruds.mahasiswa.fields.angkatan') }}</label>
                <input class="form-control {{ $errors->has('angkatan') ? 'is-invalid' : '' }}" type="text" name="angkatan" id="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}">
                @if($errors->has('angkatan'))
                    <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.angkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.mahasiswa.fields.jurusan') }}</label>
                <select class="form-control {{ $errors->has('jurusan') ? 'is-invalid' : '' }}" name="jurusan" id="jurusan">
                    <option value disabled {{ old('jurusan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Mahasiswa::JURUSAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jurusan', $mahasiswa->jurusan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jurusan'))
                    <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.mahasiswa.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $mahasiswa->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.user_helper') }}</span>
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