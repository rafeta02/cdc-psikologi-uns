@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.magang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.magangs.update", [$magang->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.magang.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $magang->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.magang.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $magang->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.magang.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $magang->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.magang.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Magang::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $magang->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="open_date">{{ trans('cruds.magang.fields.open_date') }}</label>
                <input class="form-control date {{ $errors->has('open_date') ? 'is-invalid' : '' }}" type="text" name="open_date" id="open_date" value="{{ old('open_date', $magang->open_date) }}">
                @if($errors->has('open_date'))
                    <span class="text-danger">{{ $errors->first('open_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.open_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('close_date_exist') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="close_date_exist" value="0">
                    <input class="form-check-input" type="checkbox" name="close_date_exist" id="close_date_exist" value="1" {{ $magang->close_date_exist || old('close_date_exist', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="close_date_exist">{{ trans('cruds.magang.fields.close_date_exist') }}</label>
                </div>
                @if($errors->has('close_date_exist'))
                    <span class="text-danger">{{ $errors->first('close_date_exist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.close_date_exist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="close_date">{{ trans('cruds.magang.fields.close_date') }}</label>
                <input class="form-control date {{ $errors->has('close_date') ? 'is-invalid' : '' }}" type="text" name="close_date" id="close_date" value="{{ old('close_date', $magang->close_date) }}">
                @if($errors->has('close_date'))
                    <span class="text-danger">{{ $errors->first('close_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.close_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="persyaratan">{{ trans('cruds.magang.fields.persyaratan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('persyaratan') ? 'is-invalid' : '' }}" name="persyaratan" id="persyaratan">{!! old('persyaratan', $magang->persyaratan) !!}</textarea>
                @if($errors->has('persyaratan'))
                    <span class="text-danger">{{ $errors->first('persyaratan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.persyaratan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registrasi">{{ trans('cruds.magang.fields.registrasi') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('registrasi') ? 'is-invalid' : '' }}" name="registrasi" id="registrasi">{!! old('registrasi', $magang->registrasi) !!}</textarea>
                @if($errors->has('registrasi'))
                    <span class="text-danger">{{ $errors->first('registrasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.registrasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="needs">{{ trans('cruds.magang.fields.needs') }}</label>
                <input class="form-control {{ $errors->has('needs') ? 'is-invalid' : '' }}" type="number" name="needs" id="needs" value="{{ old('needs', $magang->needs) }}" step="1">
                @if($errors->has('needs'))
                    <span class="text-danger">{{ $errors->first('needs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.needs_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filled">{{ trans('cruds.magang.fields.filled') }}</label>
                <input class="form-control {{ $errors->has('filled') ? 'is-invalid' : '' }}" type="number" name="filled" id="filled" value="{{ old('filled', $magang->filled) }}" step="1">
                @if($errors->has('filled'))
                    <span class="text-danger">{{ $errors->first('filled') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.filled_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ $magang->featured || old('featured', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">{{ trans('cruds.magang.fields.featured') }}</label>
                </div>
                @if($errors->has('featured'))
                    <span class="text-danger">{{ $errors->first('featured') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.magang.fields.featured_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.magangs.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $magang->id ?? 0 }}');
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

@endsection