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
                    {{ trans('global.create') }} {{ trans('cruds.tracerAlumnu.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tracer-alumnus.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.tracerAlumnu.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="telephone">{{ trans('cruds.tracerAlumnu.fields.telephone') }}</label>
                            <input class="form-control" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}" required>
                            @if($errors->has('telephone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telephone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.telephone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.tracerAlumnu.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.tracerAlumnu.fields.angkatan') }}</label>
                            <select class="form-control select2" name="angkatan" id="angkatan" required>
                                <option value disabled {{ old('angkatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TracerAlumnu::ANGKATAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('angkatan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                            <label class="required" for="kota_asal_id">{{ trans('cruds.tracerAlumnu.fields.kota_asal') }}</label>
                            <select class="form-control select2" name="kota_asal_id" id="kota_asal_id" required>
                            </select>
                            @if($errors->has('kota_asal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kota_asal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_asal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="kota_domisili_id">{{ trans('cruds.tracerAlumnu.fields.kota_domisili') }}</label>
                            <select class="form-control select2" name="kota_domisili_id" id="kota_domisili_id" required>
                            </select>
                            @if($errors->has('kota_domisili'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kota_domisili') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerAlumnu.fields.kota_domisili_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.tracerAlumnu.fields.partisipasi') }}</label>
                            @foreach(App\Models\TracerAlumnu::PARTISIPASI_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="partisipasi_{{ $key }}" name="partisipasi" value="{{ $key }}" {{ old('partisipasi', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="partisipasi_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('partisipasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('partisipasi') }}
                                </div>
                            @endif
                            <span class="help-block with-icon">{{ trans('cruds.tracerAlumnu.fields.partisipasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.tracerAlumnu.fields.kesibukan') }}</label>
                            <select class="form-control" name="kesibukan" id="kesibukan">
                                <option value disabled {{ old('kesibukan', null) === null ? 'selected' : '' }} required>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TracerAlumnu::KESIBUKAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('kesibukan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kesibukan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kesibukan') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_instansi">{{ trans('cruds.tracerAlumnu.fields.nama_instansi') }}</label>
                            <input class="form-control" type="text" name="nama_instansi" id="nama_instansi" value="{{ old('nama_instansi', '') }}" required>
                            @if($errors->has('nama_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_instansi') }}
                                </div>
                            @endif
                            <span class="help-block with-icon">{{ trans('cruds.tracerAlumnu.fields.nama_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required"  for="jabatan_instansi">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi') }}</label>
                            <input class="form-control" type="text" name="jabatan_instansi" id="jabatan_instansi" value="{{ old('jabatan_instansi', '') }}" required>
                            @if($errors->has('jabatan_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jabatan_instansi') }}
                                </div>
                            @endif
                            <span class="help-block {{ trans('cruds.tracerAlumnu.fields.jabatan_instansi_helper') ? 'with-icon' : '' }}">{{ trans('cruds.tracerAlumnu.fields.jabatan_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="pendapatan">{{ trans('cruds.tracerAlumnu.fields.pendapatan') }}</label>
                            @foreach(App\Models\TracerAlumnu::PENDAPATAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="pendapatan_{{ $key }}" name="pendapatan" value="{{ $key }}" {{ old('pendapatan', '') === (string) $key ? 'checked' : '' }} required>
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

@section('scripts')
<script>
$(document).ready(function() {
    console.log('Initializing Select2 for kota_asal_id');
    $('#kota_asal_id').select2({
        placeholder: 'Search for a City or Province',
        ajax: {
            url: '{{ route("admin.provinces.getProvincesWithRegencies") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 3 // minimum chars to search
    });
    console.log('Initializing Select2 for kota_asal_id');
    $('#kota_domisili_id').select2({
        placeholder: 'Search for a City or Province',
        ajax: {
            url: '{{ route("admin.provinces.getProvincesWithRegencies") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 3 // minimum chars to search
    });
});
</script>
@endsection
