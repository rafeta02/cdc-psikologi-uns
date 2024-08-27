@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prestasi-mahasiswas.update", [$prestasiMahasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.prestasiMahasiswa.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $prestasiMahasiswa->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</label>
                @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('skim') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="skim_{{ $key }}" name="skim" value="{{ $key }}" {{ old('skim', $prestasiMahasiswa->skim) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="skim_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('skim'))
                    <span class="text-danger">{{ $errors->first('skim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.skim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</label>
                @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('tingkat') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" {{ old('tingkat', $prestasiMahasiswa->tingkat) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="tingkat_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('tingkat'))
                    <span class="text-danger">{{ $errors->first('tingkat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tingkat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_kegiatan">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</label>
                <input class="form-control {{ $errors->has('nama_kegiatan') ? 'is-invalid' : '' }}" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $prestasiMahasiswa->nama_kegiatan) }}" required>
                @if($errors->has('nama_kegiatan'))
                    <span class="text-danger">{{ $errors->first('nama_kegiatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategori_id">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</label>
                <select class="form-control select2 {{ $errors->has('kategori') ? 'is-invalid' : '' }}" name="kategori_id" id="kategori_id">
                    @foreach($kategoris as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kategori_id') ? old('kategori_id') : $prestasiMahasiswa->kategori->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori'))
                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.kategori_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_awal">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_awal') ? 'is-invalid' : '' }}" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal', $prestasiMahasiswa->tanggal_awal) }}">
                @if($errors->has('tanggal_awal'))
                    <span class="text-danger">{{ $errors->first('tanggal_awal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_akhir') ? 'is-invalid' : '' }}" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', $prestasiMahasiswa->tanggal_akhir) }}">
                @if($errors->has('tanggal_akhir'))
                    <span class="text-danger">{{ $errors->first('tanggal_akhir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}</label>
                @foreach(App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('jumlah_peserta') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" value="{{ $key }}" {{ old('jumlah_peserta', $prestasiMahasiswa->jumlah_peserta) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jumlah_peserta_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('jumlah_peserta'))
                    <span class="text-danger">{{ $errors->first('jumlah_peserta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}</label>
                <select class="form-control {{ $errors->has('perolehan_juara') ? 'is-invalid' : '' }}" name="perolehan_juara" id="perolehan_juara" required>
                    <option value disabled {{ old('perolehan_juara', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('perolehan_juara', $prestasiMahasiswa->perolehan_juara) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('perolehan_juara'))
                    <span class="text-danger">{{ $errors->first('perolehan_juara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}</label>
                <input class="form-control {{ $errors->has('nama_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', $prestasiMahasiswa->nama_penyelenggara) }}" required>
                @if($errors->has('nama_penyelenggara'))
                    <span class="text-danger">{{ $errors->first('nama_penyelenggara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tempat_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}</label>
                <input class="form-control {{ $errors->has('tempat_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', $prestasiMahasiswa->tempat_penyelenggara) }}" required>
                @if($errors->has('tempat_penyelenggara'))
                    <span class="text-danger">{{ $errors->first('tempat_penyelenggara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</label>
                @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('keikutsertaan') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" value="{{ $key }}" {{ old('keikutsertaan', $prestasiMahasiswa->keikutsertaan) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('keikutsertaan'))
                    <span class="text-danger">{{ $errors->first('keikutsertaan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_publikasi">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}</label>
                <input class="form-control {{ $errors->has('url_publikasi') ? 'is-invalid' : '' }}" type="text" name="url_publikasi" id="url_publikasi" value="{{ old('url_publikasi', $prestasiMahasiswa->url_publikasi) }}">
                @if($errors->has('url_publikasi'))
                    <span class="text-danger">{{ $errors->first('url_publikasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}</label>
                <div class="needsclick dropzone {{ $errors->has('surat_tugas') ? 'is-invalid' : '' }}" id="surat_tugas-dropzone">
                </div>
                @if($errors->has('surat_tugas'))
                    <span class="text-danger">{{ $errors->first('surat_tugas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sertifikat') ? 'is-invalid' : '' }}" id="sertifikat-dropzone">
                </div>
                @if($errors->has('sertifikat'))
                    <span class="text-danger">{{ $errors->first('sertifikat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foto_dokumentasi">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto_dokumentasi') ? 'is-invalid' : '' }}" id="foto_dokumentasi-dropzone">
                </div>
                @if($errors->has('foto_dokumentasi'))
                    <span class="text-danger">{{ $errors->first('foto_dokumentasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="surat_tugas_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}</label>
                <div class="needsclick dropzone {{ $errors->has('surat_tugas_pembimbing') ? 'is-invalid' : '' }}" id="surat_tugas_pembimbing-dropzone">
                </div>
                @if($errors->has('surat_tugas_pembimbing'))
                    <span class="text-danger">{{ $errors->first('surat_tugas_pembimbing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bukti_sipsmart">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}</label>
                <div class="needsclick dropzone {{ $errors->has('bukti_sipsmart') ? 'is-invalid' : '' }}" id="bukti_sipsmart-dropzone">
                </div>
                @if($errors->has('bukti_sipsmart'))
                    <span class="text-danger">{{ $errors->first('bukti_sipsmart') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}</label>
                <input class="form-control {{ $errors->has('no_wa') ? 'is-invalid' : '' }}" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $prestasiMahasiswa->no_wa) }}" required>
                @if($errors->has('no_wa'))
                    <span class="text-danger">{{ $errors->first('no_wa') }}</span>
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



@endsection

@section('scripts')
<script>
    var uploadedSuratTugasMap = {}
Dropzone.options.suratTugasDropzone = {
    url: '{{ route('admin.prestasi-mahasiswas.storeMedia') }}',
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
    url: '{{ route('admin.prestasi-mahasiswas.storeMedia') }}',
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
    url: '{{ route('admin.prestasi-mahasiswas.storeMedia') }}',
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
    url: '{{ route('admin.prestasi-mahasiswas.storeMedia') }}',
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
    url: '{{ route('admin.prestasi-mahasiswas.storeMedia') }}',
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