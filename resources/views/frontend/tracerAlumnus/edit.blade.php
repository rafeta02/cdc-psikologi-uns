@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3>Data Tracer Alumni</h3>
        </div>

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.tracerAlumnu.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tracer-alumnus.update", [$tracerAlumnu->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.tracerAlumnu.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $tracerAlumnu->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.tracerAlumnu.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', $tracerAlumnu->nama) }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="telephone">{{ trans('cruds.tracerAlumnu.fields.telephone') }}</label>
                            <input class="form-control" type="text" name="telephone" id="telephone" value="{{ old('telephone', $tracerAlumnu->telephone) }}" required>
                            @if($errors->has('telephone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telephone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.telephone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.tracerAlumnu.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $tracerAlumnu->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.tracerAlumnu.fields.angkatan') }}</label>
                            <select class="form-control" name="angkatan" id="angkatan" required>
                                <option value disabled {{ old('angkatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TracerAlumnu::ANGKATAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('angkatan', $tracerAlumnu->angkatan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('angkatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('angkatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.angkatan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kota_asal_id">{{ trans('cruds.tracerAlumnu.fields.kota_asal') }}</label>
                            <select class="form-control select2" name="kota_asal_id" id="kota_asal_id">
                                @foreach($kota_asals as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('kota_asal_id') ? old('kota_asal_id') : $tracerAlumnu->kota_asal->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kota_asal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kota_asal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_asal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kota_domisili_id">{{ trans('cruds.tracerAlumnu.fields.kota_domisili') }}</label>
                            <select class="form-control select2" name="kota_domisili_id" id="kota_domisili_id">
                                @foreach($kota_domisilis as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('kota_domisili_id') ? old('kota_domisili_id') : $tracerAlumnu->kota_domisili->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kota_domisili'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kota_domisili') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_domisili_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerAlumnu.fields.partisipasi') }}</label>
                            @foreach(App\Models\TracerAlumnu::PARTISIPASI_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="partisipasi_{{ $key }}" name="partisipasi" value="{{ $key }}" {{ old('partisipasi', $tracerAlumnu->partisipasi) === (string) $key ? 'checked' : '' }}>
                                    <label for="partisipasi_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('partisipasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('partisipasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.partisipasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerAlumnu.fields.kesibukan') }}</label>
                            <select class="form-control" name="kesibukan" id="kesibukan">
                                <option value disabled {{ old('kesibukan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TracerAlumnu::KESIBUKAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('kesibukan', $tracerAlumnu->kesibukan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kesibukan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kesibukan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kesibukan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama_instansi">{{ trans('cruds.tracerAlumnu.fields.nama_instansi') }}</label>
                            <input class="form-control" type="text" name="nama_instansi" id="nama_instansi" value="{{ old('nama_instansi', $tracerAlumnu->nama_instansi) }}">
                            @if($errors->has('nama_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.nama_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="jabatan_instansi">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi') }}</label>
                            <input class="form-control" type="text" name="jabatan_instansi" id="jabatan_instansi" value="{{ old('jabatan_instansi', $tracerAlumnu->jabatan_instansi) }}">
                            @if($errors->has('jabatan_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jabatan_instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerAlumnu.fields.pendapatan') }}</label>
                            @foreach(App\Models\TracerAlumnu::PENDAPATAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="pendapatan_{{ $key }}" name="pendapatan" value="{{ $key }}" {{ old('pendapatan', $tracerAlumnu->pendapatan) === (string) $key ? 'checked' : '' }}>
                                    <label for="pendapatan_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('pendapatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pendapatan') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection
