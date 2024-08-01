@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prestasiMahasiswaDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prestasi-mahasiswa-details.update", [$prestasiMahasiswaDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nim">{{ trans('cruds.prestasiMahasiswaDetail.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', $prestasiMahasiswaDetail->nim) }}" required>
                @if($errors->has('nim'))
                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswaDetail.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.prestasiMahasiswaDetail.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $prestasiMahasiswaDetail->nama) }}" required>
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswaDetail.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prestasi_mahasiswa_id">{{ trans('cruds.prestasiMahasiswaDetail.fields.prestasi_mahasiswa') }}</label>
                <select class="form-control select2 {{ $errors->has('prestasi_mahasiswa') ? 'is-invalid' : '' }}" name="prestasi_mahasiswa_id" id="prestasi_mahasiswa_id" required>
                    @foreach($prestasi_mahasiswas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('prestasi_mahasiswa_id') ? old('prestasi_mahasiswa_id') : $prestasiMahasiswaDetail->prestasi_mahasiswa->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prestasi_mahasiswa'))
                    <span class="text-danger">{{ $errors->first('prestasi_mahasiswa') }}</span>
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



@endsection