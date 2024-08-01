@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.tracerStakeholder.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tracer-stakeholders.update", [$tracerStakeholder->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.tracerStakeholder.fields.nama') }}</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', $tracerStakeholder->nama) }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_instansi">{{ trans('cruds.tracerStakeholder.fields.nama_instansi') }}</label>
                            <input class="form-control" type="text" name="nama_instansi" id="nama_instansi" value="{{ old('nama_instansi', $tracerStakeholder->nama_instansi) }}" required>
                            @if($errors->has('nama_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.nama_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_alumni">{{ trans('cruds.tracerStakeholder.fields.nama_alumni') }}</label>
                            <input class="form-control" type="text" name="nama_alumni" id="nama_alumni" value="{{ old('nama_alumni', $tracerStakeholder->nama_alumni) }}" required>
                            @if($errors->has('nama_alumni'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_alumni') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.nama_alumni_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tahun_lulus">{{ trans('cruds.tracerStakeholder.fields.tahun_lulus') }}</label>
                            <input class="form-control" type="number" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus', $tracerStakeholder->tahun_lulus) }}" step="1" required>
                            @if($errors->has('tahun_lulus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tahun_lulus') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.tahun_lulus_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="waktu_tunggu">{{ trans('cruds.tracerStakeholder.fields.waktu_tunggu') }}</label>
                            <input class="form-control" type="number" name="waktu_tunggu" id="waktu_tunggu" value="{{ old('waktu_tunggu', $tracerStakeholder->waktu_tunggu) }}" step="1" required>
                            @if($errors->has('waktu_tunggu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('waktu_tunggu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.waktu_tunggu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.tingkat_instansi') }}</label>
                            @foreach(App\Models\TracerStakeholder::TINGKAT_INSTANSI_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="tingkat_instansi_{{ $key }}" name="tingkat_instansi" value="{{ $key }}" {{ old('tingkat_instansi', $tracerStakeholder->tingkat_instansi) === (string) $key ? 'checked' : '' }}>
                                    <label for="tingkat_instansi_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('tingkat_instansi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tingkat_instansi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.tingkat_instansi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.tracerStakeholder.fields.kesesuaian_bidan') }}</label>
                            @foreach(App\Models\TracerStakeholder::KESESUAIAN_BIDAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kesesuaian_bidan_{{ $key }}" name="kesesuaian_bidan" value="{{ $key }}" {{ old('kesesuaian_bidan', $tracerStakeholder->kesesuaian_bidan) === (string) $key ? 'checked' : '' }} required>
                                    <label for="kesesuaian_bidan_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kesesuaian_bidan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kesesuaian_bidan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kesesuaian_bidan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_integritas') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_INTEGRITAS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_integritas_{{ $key }}" name="kompetensi_integritas" value="{{ $key }}" {{ old('kompetensi_integritas', $tracerStakeholder->kompetensi_integritas) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_integritas_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_integritas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_integritas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_integritas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_profesionalisme') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_PROFESIONALISME_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_profesionalisme_{{ $key }}" name="kompetensi_profesionalisme" value="{{ $key }}" {{ old('kompetensi_profesionalisme', $tracerStakeholder->kompetensi_profesionalisme) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_profesionalisme_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_profesionalisme'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_profesionalisme') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_profesionalisme_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_inggris') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_INGGRIS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_inggris_{{ $key }}" name="kompetensi_inggris" value="{{ $key }}" {{ old('kompetensi_inggris', $tracerStakeholder->kompetensi_inggris) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_inggris_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_inggris'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_inggris') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_inggris_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_it') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_IT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_it_{{ $key }}" name="kompetensi_it" value="{{ $key }}" {{ old('kompetensi_it', $tracerStakeholder->kompetensi_it) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_it_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_it'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_it') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_it_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_komunikasi') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_KOMUNIKASI_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_komunikasi_{{ $key }}" name="kompetensi_komunikasi" value="{{ $key }}" {{ old('kompetensi_komunikasi', $tracerStakeholder->kompetensi_komunikasi) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_komunikasi_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_komunikasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_komunikasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_komunikasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_kerjasama') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_KERJASAMA_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_kerjasama_{{ $key }}" name="kompetensi_kerjasama" value="{{ $key }}" {{ old('kompetensi_kerjasama', $tracerStakeholder->kompetensi_kerjasama) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_kerjasama_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_kerjasama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_kerjasama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_kerjasama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.kompetensi_pengembangan') }}</label>
                            @foreach(App\Models\TracerStakeholder::KOMPETENSI_PENGEMBANGAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="kompetensi_pengembangan_{{ $key }}" name="kompetensi_pengembangan" value="{{ $key }}" {{ old('kompetensi_pengembangan', $tracerStakeholder->kompetensi_pengembangan) === (string) $key ? 'checked' : '' }}>
                                    <label for="kompetensi_pengembangan_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('kompetensi_pengembangan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kompetensi_pengembangan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kompetensi_pengembangan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kepuasan_alumni">{{ trans('cruds.tracerStakeholder.fields.kepuasan_alumni') }}</label>
                            <textarea class="form-control" name="kepuasan_alumni" id="kepuasan_alumni">{{ old('kepuasan_alumni', $tracerStakeholder->kepuasan_alumni) }}</textarea>
                            @if($errors->has('kepuasan_alumni'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kepuasan_alumni') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.kepuasan_alumni_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="saran">{{ trans('cruds.tracerStakeholder.fields.saran') }}</label>
                            <textarea class="form-control" name="saran" id="saran">{{ old('saran', $tracerStakeholder->saran) }}</textarea>
                            @if($errors->has('saran'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('saran') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.saran_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tracerStakeholder.fields.ketersediaan_campus_hiring') }}</label>
                            @foreach(App\Models\TracerStakeholder::KETERSEDIAAN_CAMPUS_HIRING_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="ketersediaan_campus_hiring_{{ $key }}" name="ketersediaan_campus_hiring" value="{{ $key }}" {{ old('ketersediaan_campus_hiring', $tracerStakeholder->ketersediaan_campus_hiring) === (string) $key ? 'checked' : '' }}>
                                    <label for="ketersediaan_campus_hiring_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('ketersediaan_campus_hiring'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ketersediaan_campus_hiring') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.ketersediaan_campus_hiring_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanda_tangan">{{ trans('cruds.tracerStakeholder.fields.tanda_tangan') }}</label>
                            <div class="needsclick dropzone" id="tanda_tangan-dropzone">
                            </div>
                            @if($errors->has('tanda_tangan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanda_tangan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tracerStakeholder.fields.tanda_tangan_helper') }}</span>
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
    Dropzone.options.tandaTanganDropzone = {
    url: '{{ route('frontend.tracer-stakeholders.storeMedia') }}',
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
      $('form').find('input[name="tanda_tangan"]').remove()
      $('form').append('<input type="hidden" name="tanda_tangan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="tanda_tangan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($tracerStakeholder) && $tracerStakeholder->tanda_tangan)
      var file = {!! json_encode($tracerStakeholder->tanda_tangan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="tanda_tangan" value="' + file.file_name + '">')
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
@endsection