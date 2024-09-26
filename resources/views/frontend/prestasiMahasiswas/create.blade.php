@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Prestasi Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.prestasi-mahasiswas.index') }}">Prestasi Mahasiswa</a></li>
                <li class="breadcrumb-item active">Tambah Prestasi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.prestasi-mahasiswas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="skim_{{ $key }}" name="skim" value="{{ $key }}" {{ old('skim', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="skim_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('skim'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('skim') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.skim_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" {{ old('tingkat', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="tingkat_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('tingkat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tingkat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tingkat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_kegiatan">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</label>
                            <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', '') }}" required>
                            @if($errors->has('nama_kegiatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_kegiatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</label>
                            <select class="form-control select2" name="kategori_id" id="kategori_id">
                                @foreach($kategoris as $id => $entry)
                                    <option value="{{ $id }}" {{ old('kategori_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kategori'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kategori') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.kategori_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}</label>
                            <input class="form-control date" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal') }}">
                            @if($errors->has('tanggal_awal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_awal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                            <input class="form-control date" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                            @if($errors->has('tanggal_akhir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_akhir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" value="{{ $key }}" {{ old('jumlah_peserta', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="jumlah_peserta_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('jumlah_peserta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jumlah_peserta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}</label>
                            <select class="form-control" name="perolehan_juara" id="perolehan_juara" required>
                                <option value disabled {{ old('perolehan_juara', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('perolehan_juara', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('perolehan_juara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('perolehan_juara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}</label>
                            <input class="form-control" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', '') }}" required>
                            @if($errors->has('nama_penyelenggara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_penyelenggara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tempat_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}</label>
                            <input class="form-control" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', '') }}" required>
                            @if($errors->has('tempat_penyelenggara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat_penyelenggara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" value="{{ $key }}" {{ old('keikutsertaan', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('keikutsertaan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('keikutsertaan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan_helper') }}</span>
                        </div>

                        <!-- Dynamic Nama Peserta and NIM Peserta -->
                        <div id="peserta-wrapper">
                            <div class="card mb-3 peserta-group">
                                <div class="card-header">
                                    <h5 class="card-title">Peserta 1</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_peserta">
                                            Nama Peserta
                                        </label>
                                        <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta" value="{{ old('nama_peserta.0', '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="nim_peserta">
                                            NIM Peserta
                                        </label>
                                        <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta" value="{{ old('nim_peserta.0', '') }}">
                                    </div>

                                    <button type="button" class="btn btn-success add-peserta">
                                        <i class="fas fa-plus"></i> Tambah Peserta
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="url_publikasi">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}</label>
                            <input class="form-control" type="text" name="url_publikasi" id="url_publikasi" value="{{ old('url_publikasi', '') }}">
                            @if($errors->has('url_publikasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('url_publikasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}</label>
                            <div class="needsclick dropzone" id="surat_tugas-dropzone">
                            </div>
                            @if($errors->has('surat_tugas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}</label>
                            <div class="needsclick dropzone" id="sertifikat-dropzone">
                            </div>
                            @if($errors->has('sertifikat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sertifikat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="foto_dokumentasi">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}</label>
                            <div class="needsclick dropzone" id="foto_dokumentasi-dropzone">
                            </div>
                            @if($errors->has('foto_dokumentasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('foto_dokumentasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_tugas_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}</label>
                            <div class="needsclick dropzone" id="surat_tugas_pembimbing-dropzone">
                            </div>
                            @if($errors->has('surat_tugas_pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas_pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bukti_sipsmart">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}</label>
                            <div class="needsclick dropzone" id="bukti_sipsmart-dropzone">
                            </div>
                            @if($errors->has('bukti_sipsmart'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bukti_sipsmart') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}</label>
                            <input class="form-control" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', '') }}" required>
                            @if($errors->has('no_wa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_wa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.no_wa_helper') }}</span>
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
    document.addEventListener('DOMContentLoaded', function() {
        let pesertaWrapper = document.getElementById('peserta-wrapper');
        let pesertaIndex = 1;

        function updatePesertaTitles() {
            let pesertaGroups = document.querySelectorAll('.peserta-group');
            pesertaGroups.forEach((group, index) => {
                group.querySelector('.card-title').textContent = `Peserta ${index + 1}`;
                group.querySelector('input[name="nama_peserta[]"]').id = `nama_peserta_${index}`;
                group.querySelector('input[name="nim_peserta[]"]').id = `nim_peserta_${index}`;
            });
        }

        document.querySelector('.add-peserta').addEventListener('click', function() {
            let newPesertaGroup = document.querySelector('.peserta-group').cloneNode(true);
            newPesertaGroup.querySelectorAll('input').forEach(input => input.value = '');
            newPesertaGroup.querySelector('.add-peserta').innerHTML = '<i class="fas fa-minus"></i> Remove Peserta';
            newPesertaGroup.querySelector('.add-peserta').classList.remove('btn-success');
            newPesertaGroup.querySelector('.add-peserta').classList.add('btn-danger');
            newPesertaGroup.querySelector('.add-peserta').classList.add('remove-peserta');
            pesertaWrapper.appendChild(newPesertaGroup);
            pesertaIndex++;
            updatePesertaTitles();
        });

        pesertaWrapper.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-peserta')) {
                e.target.closest('.peserta-group').remove();
                pesertaIndex--;
                updatePesertaTitles();
            }
        });

        updatePesertaTitles();
    });
</script>
<script>
var uploadedSuratTugasMap = {}
Dropzone.options.suratTugasDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="surat_tugas[]" value="' + response.name + '">')
      uploadedSuratTugasMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSuratTugasMap[file.name]
      }
      $('form').find('input[name="surat_tugas[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->surat_tugas)
          var files =
            {!! json_encode($prestasiMahasiswa->surat_tugas) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="surat_tugas[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedSertifikatMap = {}
Dropzone.options.sertifikatDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="sertifikat[]" value="' + response.name + '">')
      uploadedSertifikatMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSertifikatMap[file.name]
      }
      $('form').find('input[name="sertifikat[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->sertifikat)
          var files =
            {!! json_encode($prestasiMahasiswa->sertifikat) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="sertifikat[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedFotoDokumentasiMap = {}
Dropzone.options.fotoDokumentasiDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + response.name + '">')
      uploadedFotoDokumentasiMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFotoDokumentasiMap[file.name]
      }
      $('form').find('input[name="foto_dokumentasi[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->foto_dokumentasi)
      var files = {!! json_encode($prestasiMahasiswa->foto_dokumentasi) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
<script>
    Dropzone.options.suratTugasPembimbingDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="surat_tugas_pembimbing"]').remove()
      $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="surat_tugas_pembimbing"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->surat_tugas_pembimbing)
      var file = {!! json_encode($prestasiMahasiswa->surat_tugas_pembimbing) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedBuktiSipsmartMap = {}
Dropzone.options.buktiSipsmartDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + response.name + '">')
      uploadedBuktiSipsmartMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBuktiSipsmartMap[file.name]
      }
      $('form').find('input[name="bukti_sipsmart[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->bukti_sipsmart)
      var files = {!! json_encode($prestasiMahasiswa->bukti_sipsmart) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection
