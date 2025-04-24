@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.mahasiswa-magangs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="mahasiswa_id">{{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}</label>
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
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.mahasiswa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nim">{{ trans('cruds.mahasiswaMagang.fields.nim') }}</label>
                            <input class="form-control" type="text" name="nim" id="nim" value="{{ old('nim', '') }}">
                            @if($errors->has('nim'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nim') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.nim_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.mahasiswaMagang.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', '') }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="semester">{{ trans('cruds.mahasiswaMagang.fields.semester') }}</label>
                            <input class="form-control" type="number" name="semester" id="semester" value="{{ old('semester', '') }}" step="1">
                            @if($errors->has('semester'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('semester') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.semester_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.mahasiswaMagang.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MahasiswaMagang::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.mahasiswaMagang.fields.bidang') }}</label>
                            <select class="form-control" name="bidang" id="bidang">
                                <option value disabled {{ old('bidang', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MahasiswaMagang::BIDANG_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('bidang', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bidang'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bidang') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.bidang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="magang_id">{{ trans('cruds.mahasiswaMagang.fields.magang') }}</label>
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
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.magang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="instansi">{{ trans('cruds.mahasiswaMagang.fields.instansi') }}</label>
                            <input class="form-control" type="text" name="instansi" id="instansi" value="{{ old('instansi', '') }}">
                            @if($errors->has('instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="alamat_instansi">{{ trans('cruds.mahasiswaMagang.fields.alamat_instansi') }}</label>
                            <textarea class="form-control" name="alamat_instansi" id="alamat_instansi">{{ old('alamat_instansi') }}</textarea>
                            @if($errors->has('alamat_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alamat_instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.alamat_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.mahasiswaMagang.fields.approve') }}</label>
                            <select class="form-control" name="approve" id="approve">
                                <option value disabled {{ old('approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MahasiswaMagang::APPROVE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('approve', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('approve'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('approve') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.approve_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="approved_by_id">{{ trans('cruds.mahasiswaMagang.fields.approved_by') }}</label>
                            <select class="form-control select2" name="approved_by_id" id="approved_by_id">
                                @foreach($approved_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('approved_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('approved_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('approved_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.approved_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="pretest" value="0">
                                <input type="checkbox" name="pretest" id="pretest" value="1" {{ old('pretest', 0) == 1 ? 'checked' : '' }}>
                                <label for="pretest">{{ trans('cruds.mahasiswaMagang.fields.pretest') }}</label>
                            </div>
                            @if($errors->has('pretest'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pretest') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.pretest_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="posttest" value="0">
                                <input type="checkbox" name="posttest" id="posttest" value="1" {{ old('posttest', 0) == 1 ? 'checked' : '' }}>
                                <label for="posttest">{{ trans('cruds.mahasiswaMagang.fields.posttest') }}</label>
                            </div>
                            @if($errors->has('posttest'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('posttest') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.posttest_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dosen_pembimbing">{{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing') }}</label>
                            <input class="form-control" type="text" name="dosen_pembimbing" id="dosen_pembimbing" value="{{ old('dosen_pembimbing', '') }}">
                            @if($errors->has('dosen_pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dosen_pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="laporan_akhir">{{ trans('cruds.mahasiswaMagang.fields.laporan_akhir') }}</label>
                            <div class="needsclick dropzone" id="laporan_akhir-dropzone">
                            </div>
                            @if($errors->has('laporan_akhir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('laporan_akhir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.laporan_akhir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="presensi">{{ trans('cruds.mahasiswaMagang.fields.presensi') }}</label>
                            <div class="needsclick dropzone" id="presensi-dropzone">
                            </div>
                            @if($errors->has('presensi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('presensi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.presensi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">{{ trans('cruds.mahasiswaMagang.fields.sertifikat') }}</label>
                            <div class="needsclick dropzone" id="sertifikat-dropzone">
                            </div>
                            @if($errors->has('sertifikat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sertifikat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.sertifikat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="form_penilaian_pembimbing_lapangan">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan') }}</label>
                            <div class="needsclick dropzone" id="form_penilaian_pembimbing_lapangan-dropzone">
                            </div>
                            @if($errors->has('form_penilaian_pembimbing_lapangan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('form_penilaian_pembimbing_lapangan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="form_penilaian_dosen_pembimbing">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing') }}</label>
                            <div class="needsclick dropzone" id="form_penilaian_dosen_pembimbing-dropzone">
                            </div>
                            @if($errors->has('form_penilaian_dosen_pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('form_penilaian_dosen_pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="berita_acara_seminar">{{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar') }}</label>
                            <div class="needsclick dropzone" id="berita_acara_seminar-dropzone">
                            </div>
                            @if($errors->has('berita_acara_seminar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('berita_acara_seminar') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="presensi_kehadiran_seminar">{{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar') }}</label>
                            <div class="needsclick dropzone" id="presensi_kehadiran_seminar-dropzone">
                            </div>
                            @if($errors->has('presensi_kehadiran_seminar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('presensi_kehadiran_seminar') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notulen_pertanyaan">{{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan') }}</label>
                            <div class="needsclick dropzone" id="notulen_pertanyaan-dropzone">
                            </div>
                            @if($errors->has('notulen_pertanyaan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notulen_pertanyaan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanda_bukti_penyerahan_laporan">{{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan') }}</label>
                            <div class="needsclick dropzone" id="tanda_bukti_penyerahan_laporan-dropzone">
                            </div>
                            @if($errors->has('tanda_bukti_penyerahan_laporan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanda_bukti_penyerahan_laporan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="berkas_magang">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}</label>
                            <div class="needsclick dropzone" id="berkas_magang-dropzone">
                            </div>
                            @if($errors->has('berkas_magang'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('berkas_magang') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.mahasiswaMagang.fields.verified') }}</label>
                            <select class="form-control" name="verified" id="verified">
                                <option value disabled {{ old('verified', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MahasiswaMagang::VERIFIED_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('verified', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('verified'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('verified') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.verified_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="verified_by_id">{{ trans('cruds.mahasiswaMagang.fields.verified_by') }}</label>
                            <select class="form-control select2" name="verified_by_id" id="verified_by_id">
                                @foreach($verified_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('verified_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('verified_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('verified_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.verified_by_helper') }}</span>
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
    var uploadedLaporanAkhirMap = {}
Dropzone.options.laporanAkhirDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 120, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 120
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="laporan_akhir[]" value="' + response.name + '">')
      uploadedLaporanAkhirMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLaporanAkhirMap[file.name]
      }
      $('form').find('input[name="laporan_akhir[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->laporan_akhir)
          var files =
            {!! json_encode($mahasiswaMagang->laporan_akhir) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="laporan_akhir[]" value="' + file.file_name + '">')
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
    var uploadedPresensiMap = {}
Dropzone.options.presensiDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="presensi[]" value="' + response.name + '">')
      uploadedPresensiMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPresensiMap[file.name]
      }
      $('form').find('input[name="presensi[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->presensi)
          var files =
            {!! json_encode($mahasiswaMagang->presensi) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="presensi[]" value="' + file.file_name + '">')
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
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
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
@if(isset($mahasiswaMagang) && $mahasiswaMagang->sertifikat)
          var files =
            {!! json_encode($mahasiswaMagang->sertifikat) !!}
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
    Dropzone.options.formPenilaianPembimbingLapanganDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
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
      $('form').find('input[name="form_penilaian_pembimbing_lapangan"]').remove()
      $('form').append('<input type="hidden" name="form_penilaian_pembimbing_lapangan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="form_penilaian_pembimbing_lapangan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->form_penilaian_pembimbing_lapangan)
      var file = {!! json_encode($mahasiswaMagang->form_penilaian_pembimbing_lapangan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="form_penilaian_pembimbing_lapangan" value="' + file.file_name + '">')
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
    Dropzone.options.formPenilaianDosenPembimbingDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="form_penilaian_dosen_pembimbing"]').remove()
      $('form').append('<input type="hidden" name="form_penilaian_dosen_pembimbing" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="form_penilaian_dosen_pembimbing"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->form_penilaian_dosen_pembimbing)
      var file = {!! json_encode($mahasiswaMagang->form_penilaian_dosen_pembimbing) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="form_penilaian_dosen_pembimbing" value="' + file.file_name + '">')
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
    Dropzone.options.beritaAcaraSeminarDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
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
      $('form').find('input[name="berita_acara_seminar"]').remove()
      $('form').append('<input type="hidden" name="berita_acara_seminar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="berita_acara_seminar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->berita_acara_seminar)
      var file = {!! json_encode($mahasiswaMagang->berita_acara_seminar) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="berita_acara_seminar" value="' + file.file_name + '">')
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
    var uploadedPresensiKehadiranSeminarMap = {}
Dropzone.options.presensiKehadiranSeminarDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="presensi_kehadiran_seminar[]" value="' + response.name + '">')
      uploadedPresensiKehadiranSeminarMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPresensiKehadiranSeminarMap[file.name]
      }
      $('form').find('input[name="presensi_kehadiran_seminar[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->presensi_kehadiran_seminar)
          var files =
            {!! json_encode($mahasiswaMagang->presensi_kehadiran_seminar) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="presensi_kehadiran_seminar[]" value="' + file.file_name + '">')
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
    Dropzone.options.notulenPertanyaanDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
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
      $('form').find('input[name="notulen_pertanyaan"]').remove()
      $('form').append('<input type="hidden" name="notulen_pertanyaan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="notulen_pertanyaan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->notulen_pertanyaan)
      var file = {!! json_encode($mahasiswaMagang->notulen_pertanyaan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="notulen_pertanyaan" value="' + file.file_name + '">')
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
    Dropzone.options.tandaBuktiPenyerahanLaporanDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
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
      $('form').find('input[name="tanda_bukti_penyerahan_laporan"]').remove()
      $('form').append('<input type="hidden" name="tanda_bukti_penyerahan_laporan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="tanda_bukti_penyerahan_laporan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->tanda_bukti_penyerahan_laporan)
      var file = {!! json_encode($mahasiswaMagang->tanda_bukti_penyerahan_laporan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="tanda_bukti_penyerahan_laporan" value="' + file.file_name + '">')
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
    var uploadedBerkasMagangMap = {}
Dropzone.options.berkasMagangDropzone = {
    url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
    maxFilesize: 120, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 120
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="berkas_magang[]" value="' + response.name + '">')
      uploadedBerkasMagangMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBerkasMagangMap[file.name]
      }
      $('form').find('input[name="berkas_magang[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($mahasiswaMagang) && $mahasiswaMagang->berkas_magang)
          var files =
            {!! json_encode($mahasiswaMagang->berkas_magang) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="berkas_magang[]" value="' + file.file_name + '">')
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