@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.company.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.companies.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.company.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.company.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description') !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.company.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.company.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="telephone">{{ trans('cruds.company.fields.telephone') }}</label>
                            <input class="form-control" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}">
                            @if($errors->has('telephone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telephone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.telephone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.company.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="website">{{ trans('cruds.company.fields.website') }}</label>
                            <input class="form-control" type="text" name="website" id="website" value="{{ old('website', '') }}">
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.website_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.company.fields.scale') }}</label>
                            <select class="form-control" name="scale" id="scale">
                                <option value disabled {{ old('scale', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Company::SCALE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('scale', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('scale'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('scale') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.scale_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number_of_employee">{{ trans('cruds.company.fields.number_of_employee') }}</label>
                            <input class="form-control" type="number" name="number_of_employee" id="number_of_employee" value="{{ old('number_of_employee', '0') }}" step="1">
                            @if($errors->has('number_of_employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_of_employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.number_of_employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.company.fields.ownership') }}</label>
                            <select class="form-control" name="ownership" id="ownership">
                                <option value disabled {{ old('ownership', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Company::OWNERSHIP_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('ownership', 'swasta') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ownership'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ownership') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.ownership_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="industry_id">{{ trans('cruds.company.fields.industry') }}</label>
                            <select class="form-control select2" name="industry_id" id="industry_id">
                                @foreach($industries as $id => $entry)
                                    <option value="{{ $id }}" {{ old('industry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('industry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('industry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.industry_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="location">{{ trans('cruds.company.fields.location') }}</label>
                            <input class="form-control" type="text" name="location" id="location" value="{{ old('location', '') }}">
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.location_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.companies.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $company->id ?? 0 }}');
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('frontend.companies.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->image)
      var file = {!! json_encode($company->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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