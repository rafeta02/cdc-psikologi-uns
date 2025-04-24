@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.monitoringMagang.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.monitoring-magangs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="mahasiswa_id">{{ trans('cruds.monitoringMagang.fields.mahasiswa') }}</label>
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
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.mahasiswa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="magang_id">{{ trans('cruds.monitoringMagang.fields.magang') }}</label>
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
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.magang_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing">{{ trans('cruds.monitoringMagang.fields.pembimbing') }}</label>
                            <input class="form-control" type="text" name="pembimbing" id="pembimbing" value="{{ old('pembimbing', '') }}">
                            @if($errors->has('pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">{{ trans('cruds.monitoringMagang.fields.tanggal') }}</label>
                            <input class="form-control date" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                            @if($errors->has('tanggal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.tanggal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tempat">{{ trans('cruds.monitoringMagang.fields.tempat') }}</label>
                            <input class="form-control" type="text" name="tempat" id="tempat" value="{{ old('tempat', '') }}">
                            @if($errors->has('tempat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.tempat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hasil">{{ trans('cruds.monitoringMagang.fields.hasil') }}</label>
                            <textarea class="form-control ckeditor" name="hasil" id="hasil">{!! old('hasil') !!}</textarea>
                            @if($errors->has('hasil'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hasil') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.hasil_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bukti">{{ trans('cruds.monitoringMagang.fields.bukti') }}</label>
                            <div class="needsclick dropzone" id="bukti-dropzone">
                            </div>
                            @if($errors->has('bukti'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bukti') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.monitoringMagang.fields.bukti_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('frontend.monitoring-magangs.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $monitoringMagang->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedBuktiMap = {}
Dropzone.options.buktiDropzone = {
    url: '{{ route('frontend.monitoring-magangs.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti[]" value="' + response.name + '">')
      uploadedBuktiMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBuktiMap[file.name]
      }
      $('form').find('input[name="bukti[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($monitoringMagang) && $monitoringMagang->bukti)
          var files =
            {!! json_encode($monitoringMagang->bukti) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="bukti[]" value="' + file.file_name + '">')
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