@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.prestasiMahasiswaDetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.prestasi-mahasiswa-details.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nim">{{ trans('cruds.prestasiMahasiswaDetail.fields.nim') }}</label>
                            <input class="form-control" type="text" name="nim" id="nim" value="{{ old('nim', '') }}" required>
                            @if($errors->has('nim'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nim') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswaDetail.fields.nim_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.prestasiMahasiswaDetail.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswaDetail.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="prestasi_mahasiswa_id">{{ trans('cruds.prestasiMahasiswaDetail.fields.prestasi_mahasiswa') }}</label>
                            <select class="form-control select2" name="prestasi_mahasiswa_id" id="prestasi_mahasiswa_id" required>
                                @foreach($prestasi_mahasiswas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('prestasi_mahasiswa_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('prestasi_mahasiswa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prestasi_mahasiswa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswaDetail.fields.prestasi_mahasiswa_helper') }}</span>
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