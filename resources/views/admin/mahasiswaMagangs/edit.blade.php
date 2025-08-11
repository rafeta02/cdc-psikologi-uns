@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mahasiswa-magangs.update", [$mahasiswaMagang->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="mahasiswa_id">{{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}</label>
                <select class="form-control select2 {{ $errors->has('mahasiswa') ? 'is-invalid' : '' }}" name="mahasiswa_id" id="mahasiswa_id">
                    @foreach($mahasiswas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('mahasiswa_id') ? old('mahasiswa_id') : $mahasiswaMagang->mahasiswa->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mahasiswa'))
                    <span class="text-danger">{{ $errors->first('mahasiswa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nim">{{ trans('cruds.mahasiswaMagang.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswaMagang->nim) }}">
                @if($errors->has('nim'))
                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama">{{ trans('cruds.mahasiswaMagang.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $mahasiswaMagang->nama) }}">
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="semester">{{ trans('cruds.mahasiswaMagang.fields.semester') }}</label>
                <input class="form-control {{ $errors->has('semester') ? 'is-invalid' : '' }}" type="number" name="semester" id="semester" value="{{ old('semester', $mahasiswaMagang->semester) }}" step="1">
                @if($errors->has('semester'))
                    <span class="text-danger">{{ $errors->first('semester') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.semester_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.mahasiswaMagang.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MahasiswaMagang::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $mahasiswaMagang->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.mahasiswaMagang.fields.bidang') }}</label>
                <select class="form-control {{ $errors->has('bidang') ? 'is-invalid' : '' }}" name="bidang" id="bidang">
                    <option value disabled {{ old('bidang', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MahasiswaMagang::BIDANG_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('bidang', $mahasiswaMagang->bidang) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('bidang'))
                    <span class="text-danger">{{ $errors->first('bidang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.bidang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="magang_id">{{ trans('cruds.mahasiswaMagang.fields.magang') }}</label>
                <select class="form-control select2 {{ $errors->has('magang') ? 'is-invalid' : '' }}" name="magang_id" id="magang_id">
                    @foreach($magangs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('magang_id') ? old('magang_id') : $mahasiswaMagang->magang->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('magang'))
                    <span class="text-danger">{{ $errors->first('magang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.magang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instansi">{{ trans('cruds.mahasiswaMagang.fields.instansi') }}</label>
                <input class="form-control {{ $errors->has('instansi') ? 'is-invalid' : '' }}" type="text" name="instansi" id="instansi" value="{{ old('instansi', $mahasiswaMagang->instansi) }}">
                @if($errors->has('instansi'))
                    <span class="text-danger">{{ $errors->first('instansi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.instansi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat_instansi">{{ trans('cruds.mahasiswaMagang.fields.alamat_instansi') }}</label>
                <textarea class="form-control {{ $errors->has('alamat_instansi') ? 'is-invalid' : '' }}" name="alamat_instansi" id="alamat_instansi">{{ old('alamat_instansi', $mahasiswaMagang->alamat_instansi) }}</textarea>
                @if($errors->has('alamat_instansi'))
                    <span class="text-danger">{{ $errors->first('alamat_instansi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.alamat_instansi_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.mahasiswaMagang.fields.approve') }}</label>
                <select class="form-control {{ $errors->has('approve') ? 'is-invalid' : '' }}" name="approve" id="approve">
                    <option value disabled {{ old('approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MahasiswaMagang::APPROVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('approve', $mahasiswaMagang->approve) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('approve'))
                    <span class="text-danger">{{ $errors->first('approve') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.approve_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_by_id">{{ trans('cruds.mahasiswaMagang.fields.approved_by') }}</label>
                <select class="form-control select2 {{ $errors->has('approved_by') ? 'is-invalid' : '' }}" name="approved_by_id" id="approved_by_id">
                    @foreach($approved_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('approved_by_id') ? old('approved_by_id') : $mahasiswaMagang->approved_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('approved_by'))
                    <span class="text-danger">{{ $errors->first('approved_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.approved_by_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pretest') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pretest" value="0">
                    <input class="form-check-input" type="checkbox" name="pretest" id="pretest" value="1" {{ $mahasiswaMagang->pretest || old('pretest', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pretest">{{ trans('cruds.mahasiswaMagang.fields.pretest') }}</label>
                </div>
                @if($errors->has('pretest'))
                    <span class="text-danger">{{ $errors->first('pretest') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.pretest_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('posttest') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="posttest" value="0">
                    <input class="form-check-input" type="checkbox" name="posttest" id="posttest" value="1" {{ $mahasiswaMagang->posttest || old('posttest', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="posttest">{{ trans('cruds.mahasiswaMagang.fields.posttest') }}</label>
                </div>
                @if($errors->has('posttest'))
                    <span class="text-danger">{{ $errors->first('posttest') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.posttest_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dosen_pembimbing">{{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing') }}</label>
                <select class="form-control select2 {{ $errors->has('dosen_pembimbing') ? 'is-invalid' : '' }}" name="dosen_pembimbing" id="dosen_pembimbing">
                    @foreach($dospems as $id => $entry)
                        <option value="{{ $id }}" {{ old('dosen_pembimbing', $mahasiswaMagang->dosen_pembimbing) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('dosen_pembimbing'))
                    <span class="text-danger">{{ $errors->first('dosen_pembimbing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="laporan_akhir">{{ trans('cruds.mahasiswaMagang.fields.laporan_akhir') }}</label>
                <div class="needsclick dropzone {{ $errors->has('laporan_akhir') ? 'is-invalid' : '' }}" id="laporan_akhir-dropzone">
                </div>
                @if($errors->has('laporan_akhir'))
                    <span class="text-danger">{{ $errors->first('laporan_akhir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.laporan_akhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="presensi">{{ trans('cruds.mahasiswaMagang.fields.presensi') }}</label>
                <div class="needsclick dropzone {{ $errors->has('presensi') ? 'is-invalid' : '' }}" id="presensi-dropzone">
                </div>
                @if($errors->has('presensi'))
                    <span class="text-danger">{{ $errors->first('presensi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.presensi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat">{{ trans('cruds.mahasiswaMagang.fields.sertifikat') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sertifikat') ? 'is-invalid' : '' }}" id="sertifikat-dropzone">
                </div>
                @if($errors->has('sertifikat'))
                    <span class="text-danger">{{ $errors->first('sertifikat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.sertifikat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="form_penilaian_pembimbing_lapangan">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('form_penilaian_pembimbing_lapangan') ? 'is-invalid' : '' }}" id="form_penilaian_pembimbing_lapangan-dropzone">
                </div>
                @if($errors->has('form_penilaian_pembimbing_lapangan'))
                    <span class="text-danger">{{ $errors->first('form_penilaian_pembimbing_lapangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="form_penilaian_dosen_pembimbing">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing') }}</label>
                <div class="needsclick dropzone {{ $errors->has('form_penilaian_dosen_pembimbing') ? 'is-invalid' : '' }}" id="form_penilaian_dosen_pembimbing-dropzone">
                </div>
                @if($errors->has('form_penilaian_dosen_pembimbing'))
                    <span class="text-danger">{{ $errors->first('form_penilaian_dosen_pembimbing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="berita_acara_seminar">{{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('berita_acara_seminar') ? 'is-invalid' : '' }}" id="berita_acara_seminar-dropzone">
                </div>
                @if($errors->has('berita_acara_seminar'))
                    <span class="text-danger">{{ $errors->first('berita_acara_seminar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="presensi_kehadiran_seminar">{{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('presensi_kehadiran_seminar') ? 'is-invalid' : '' }}" id="presensi_kehadiran_seminar-dropzone">
                </div>
                @if($errors->has('presensi_kehadiran_seminar'))
                    <span class="text-danger">{{ $errors->first('presensi_kehadiran_seminar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notulen_pertanyaan">{{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('notulen_pertanyaan') ? 'is-invalid' : '' }}" id="notulen_pertanyaan-dropzone">
                </div>
                @if($errors->has('notulen_pertanyaan'))
                    <span class="text-danger">{{ $errors->first('notulen_pertanyaan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanda_bukti_penyerahan_laporan">{{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('tanda_bukti_penyerahan_laporan') ? 'is-invalid' : '' }}" id="tanda_bukti_penyerahan_laporan-dropzone">
                </div>
                @if($errors->has('tanda_bukti_penyerahan_laporan'))
                    <span class="text-danger">{{ $errors->first('tanda_bukti_penyerahan_laporan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="berkas_magang">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}</label>
                <div class="needsclick dropzone {{ $errors->has('berkas_magang') ? 'is-invalid' : '' }}" id="berkas_magang-dropzone">
                </div>
                @if($errors->has('berkas_magang'))
                    <span class="text-danger">{{ $errors->first('berkas_magang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.mahasiswaMagang.fields.verified') }}</label>
                <select class="form-control {{ $errors->has('verified') ? 'is-invalid' : '' }}" name="verified" id="verified">
                    <option value disabled {{ old('verified', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MahasiswaMagang::VERIFIED_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('verified', $mahasiswaMagang->verified) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('verified'))
                    <span class="text-danger">{{ $errors->first('verified') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.verified_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verified_by_id">{{ trans('cruds.mahasiswaMagang.fields.verified_by') }}</label>
                <select class="form-control select2 {{ $errors->has('verified_by') ? 'is-invalid' : '' }}" name="verified_by_id" id="verified_by_id">
                    @foreach($verified_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('verified_by_id') ? old('verified_by_id') : $mahasiswaMagang->verified_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('verified_by'))
                    <span class="text-danger">{{ $errors->first('verified_by') }}</span>
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



@endsection

@section('scripts')
<script>
    var uploadedLaporanAkhirMap = {}
Dropzone.options.laporanAkhirDropzone = {
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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
    url: '{{ route('admin.mahasiswa-magangs.storeMedia') }}',
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