@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prestasiMaba.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prestasi-mabas.update", [$prestasiMaba->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.prestasiMaba.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $prestasiMaba->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMaba.fields.tingkat') }}</label>
                @foreach(App\Models\PrestasiMaba::TINGKAT_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('tingkat') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" {{ old('tingkat', $prestasiMaba->tingkat) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="tingkat_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('tingkat'))
                    <span class="text-danger">{{ $errors->first('tingkat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.tingkat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_kegiatan">{{ trans('cruds.prestasiMaba.fields.nama_kegiatan') }}</label>
                <input class="form-control {{ $errors->has('nama_kegiatan') ? 'is-invalid' : '' }}" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $prestasiMaba->nama_kegiatan) }}" required>
                @if($errors->has('nama_kegiatan'))
                    <span class="text-danger">{{ $errors->first('nama_kegiatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.nama_kegiatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategori_id">{{ trans('cruds.prestasiMaba.fields.kategori') }}</label>
                <select class="form-control select2 {{ $errors->has('kategori') ? 'is-invalid' : '' }}" name="kategori_id" id="kategori_id">
                    @foreach($kategoris as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kategori_id') ? old('kategori_id') : $prestasiMaba->kategori->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori'))
                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.kategori_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_awal">{{ trans('cruds.prestasiMaba.fields.tanggal_awal') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_awal') ? 'is-invalid' : '' }}" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal', $prestasiMaba->tanggal_awal) }}">
                @if($errors->has('tanggal_awal'))
                    <span class="text-danger">{{ $errors->first('tanggal_awal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.tanggal_awal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">{{ trans('cruds.prestasiMaba.fields.tanggal_akhir') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_akhir') ? 'is-invalid' : '' }}" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', $prestasiMaba->tanggal_akhir) }}">
                @if($errors->has('tanggal_akhir'))
                    <span class="text-danger">{{ $errors->first('tanggal_akhir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.tanggal_akhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMaba.fields.jumlah_peserta') }}</label>
                @foreach(App\Models\PrestasiMaba::JUMLAH_PESERTA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('jumlah_peserta') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" value="{{ $key }}" {{ old('jumlah_peserta', $prestasiMaba->jumlah_peserta) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jumlah_peserta_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('jumlah_peserta'))
                    <span class="text-danger">{{ $errors->first('jumlah_peserta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.jumlah_peserta_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prestasiMaba.fields.perolehan_juara') }}</label>
                <select class="form-control {{ $errors->has('perolehan_juara') ? 'is-invalid' : '' }}" name="perolehan_juara" id="perolehan_juara" required>
                    <option value disabled {{ old('perolehan_juara', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PrestasiMaba::PEROLEHAN_JUARA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('perolehan_juara', $prestasiMaba->perolehan_juara) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('perolehan_juara'))
                    <span class="text-danger">{{ $errors->first('perolehan_juara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.perolehan_juara_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_penyelenggara">{{ trans('cruds.prestasiMaba.fields.nama_penyelenggara') }}</label>
                <input class="form-control {{ $errors->has('nama_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', $prestasiMaba->nama_penyelenggara) }}" required>
                @if($errors->has('nama_penyelenggara'))
                    <span class="text-danger">{{ $errors->first('nama_penyelenggara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.nama_penyelenggara_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tempat_penyelenggara">{{ trans('cruds.prestasiMaba.fields.tempat_penyelenggara') }}</label>
                <input class="form-control {{ $errors->has('tempat_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', $prestasiMaba->tempat_penyelenggara) }}" required>
                @if($errors->has('tempat_penyelenggara'))
                    <span class="text-danger">{{ $errors->first('tempat_penyelenggara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.tempat_penyelenggara_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.prestasiMaba.fields.keikutsertaan') }}</label>
                @foreach(App\Models\PrestasiMaba::KEIKUTSERTAAN_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('keikutsertaan') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" value="{{ $key }}" {{ old('keikutsertaan', $prestasiMaba->keikutsertaan) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('keikutsertaan'))
                    <span class="text-danger">{{ $errors->first('keikutsertaan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.keikutsertaan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bukti_kegiatan">{{ trans('cruds.prestasiMaba.fields.bukti_kegiatan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('bukti_kegiatan') ? 'is-invalid' : '' }}" id="bukti_kegiatan-dropzone">
                </div>
                @if($errors->has('bukti_kegiatan'))
                    <span class="text-danger">{{ $errors->first('bukti_kegiatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prestasiMaba.fields.bukti_kegiatan_helper') }}</span>
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
    var uploadedBuktiKegiatanMap = {}
Dropzone.options.buktiKegiatanDropzone = {
    url: '{{ route('admin.prestasi-mabas.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti_kegiatan[]" value="' + response.name + '">')
      uploadedBuktiKegiatanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBuktiKegiatanMap[file.name]
      }
      $('form').find('input[name="bukti_kegiatan[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMaba) && $prestasiMaba->bukti_kegiatan)
          var files =
            {!! json_encode($prestasiMaba->bukti_kegiatan) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="bukti_kegiatan[]" value="' + file.file_name + '">')
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