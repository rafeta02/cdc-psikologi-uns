@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tracerAlumnu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tracer-alumnus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.tracerAlumnu.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.tracerAlumnu.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="telephone">{{ trans('cruds.tracerAlumnu.fields.telephone') }}</label>
                <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}" required>
                @if($errors->has('telephone'))
                    <span class="text-danger">{{ $errors->first('telephone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.telephone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.tracerAlumnu.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.tracerAlumnu.fields.angkatan') }}</label>
                <select class="form-control {{ $errors->has('angkatan') ? 'is-invalid' : '' }}" name="angkatan" id="angkatan" required>
                    <option value disabled {{ old('angkatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TracerAlumnu::ANGKATAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('angkatan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('angkatan'))
                    <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.angkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kota_asal_id">{{ trans('cruds.tracerAlumnu.fields.kota_asal') }}</label>
                <select class="form-control select2 {{ $errors->has('kota_asal') ? 'is-invalid' : '' }}" name="kota_asal_id" id="kota_asal_id">
                    @foreach($kota_asals as $id => $entry)
                        <option value="{{ $id }}" {{ old('kota_asal_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kota_asal'))
                    <span class="text-danger">{{ $errors->first('kota_asal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_asal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kota_domisili_id">{{ trans('cruds.tracerAlumnu.fields.kota_domisili') }}</label>
                <select class="form-control select2 {{ $errors->has('kota_domisili') ? 'is-invalid' : '' }}" name="kota_domisili_id" id="kota_domisili_id">
                    @foreach($kota_domisilis as $id => $entry)
                        <option value="{{ $id }}" {{ old('kota_domisili_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kota_domisili'))
                    <span class="text-danger">{{ $errors->first('kota_domisili') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_domisili_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tracerAlumnu.fields.partisipasi') }}</label>
                @foreach(App\Models\TracerAlumnu::PARTISIPASI_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('partisipasi') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="partisipasi_{{ $key }}" name="partisipasi" value="{{ $key }}" {{ old('partisipasi', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="partisipasi_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('partisipasi'))
                    <span class="text-danger">{{ $errors->first('partisipasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.partisipasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tracerAlumnu.fields.kesibukan') }}</label>
                <select class="form-control {{ $errors->has('kesibukan') ? 'is-invalid' : '' }}" name="kesibukan" id="kesibukan">
                    <option value disabled {{ old('kesibukan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TracerAlumnu::KESIBUKAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('kesibukan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('kesibukan'))
                    <span class="text-danger">{{ $errors->first('kesibukan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kesibukan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_instansi">{{ trans('cruds.tracerAlumnu.fields.nama_instansi') }}</label>
                <input class="form-control {{ $errors->has('nama_instansi') ? 'is-invalid' : '' }}" type="text" name="nama_instansi" id="nama_instansi" value="{{ old('nama_instansi', '') }}">
                @if($errors->has('nama_instansi'))
                    <span class="text-danger">{{ $errors->first('nama_instansi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.nama_instansi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jabatan_instansi">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi') }}</label>
                <input class="form-control {{ $errors->has('jabatan_instansi') ? 'is-invalid' : '' }}" type="text" name="jabatan_instansi" id="jabatan_instansi" value="{{ old('jabatan_instansi', '') }}">
                @if($errors->has('jabatan_instansi'))
                    <span class="text-danger">{{ $errors->first('jabatan_instansi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tracerAlumnu.fields.pendapatan') }}</label>
                @foreach(App\Models\TracerAlumnu::PENDAPATAN_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('pendapatan') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="pendapatan_{{ $key }}" name="pendapatan" value="{{ $key }}" {{ old('pendapatan', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="pendapatan_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('pendapatan'))
                    <span class="text-danger">{{ $errors->first('pendapatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.pendapatan_helper') }}</span>
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