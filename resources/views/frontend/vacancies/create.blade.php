@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.vacancy.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.vacancies.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.vacancy.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.vacancy.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.vacancy.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description') !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.vacancy.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Vacancy::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="open_date">{{ trans('cruds.vacancy.fields.open_date') }}</label>
                            <input class="form-control date" type="text" name="open_date" id="open_date" value="{{ old('open_date') }}">
                            @if($errors->has('open_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('open_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.open_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="close_date">{{ trans('cruds.vacancy.fields.close_date') }}</label>
                            <input class="form-control date" type="text" name="close_date" id="close_date" value="{{ old('close_date') }}">
                            @if($errors->has('close_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('close_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.close_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="persyaratan_umum">{{ trans('cruds.vacancy.fields.persyaratan_umum') }}</label>
                            <textarea class="form-control ckeditor" name="persyaratan_umum" id="persyaratan_umum">{!! old('persyaratan_umum') !!}</textarea>
                            @if($errors->has('persyaratan_umum'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('persyaratan_umum') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.persyaratan_umum_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="persyaratan_khusus">{{ trans('cruds.vacancy.fields.persyaratan_khusus') }}</label>
                            <textarea class="form-control ckeditor" name="persyaratan_khusus" id="persyaratan_khusus">{!! old('persyaratan_khusus') !!}</textarea>
                            @if($errors->has('persyaratan_khusus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('persyaratan_khusus') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.persyaratan_khusus_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="registration">{{ trans('cruds.vacancy.fields.registration') }}</label>
                            <textarea class="form-control ckeditor" name="registration" id="registration">{!! old('registration') !!}</textarea>
                            @if($errors->has('registration'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('registration') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.registration_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="job_description">{{ trans('cruds.vacancy.fields.job_description') }}</label>
                            <textarea class="form-control ckeditor" name="job_description" id="job_description">{!! old('job_description') !!}</textarea>
                            @if($errors->has('job_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.job_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="experience_id">{{ trans('cruds.vacancy.fields.experience') }}</label>
                            <select class="form-control select2" name="experience_id" id="experience_id">
                                @foreach($experiences as $id => $entry)
                                    <option value="{{ $id }}" {{ old('experience_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('experience'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('experience') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.experience_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="education">{{ trans('cruds.vacancy.fields.education') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="education[]" id="education" multiple>
                                @foreach($education as $id => $education)
                                    <option value="{{ $id }}" {{ in_array($id, old('education', [])) ? 'selected' : '' }}>{{ $education }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('education'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('education') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.education_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="departments">{{ trans('cruds.vacancy.fields.department') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="departments[]" id="departments" multiple>
                                @foreach($departments as $id => $department)
                                    <option value="{{ $id }}" {{ in_array($id, old('departments', [])) ? 'selected' : '' }}>{{ $department }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('departments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('departments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.department_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="minimum_gpa">{{ trans('cruds.vacancy.fields.minimum_gpa') }}</label>
                            <input class="form-control" type="number" name="minimum_gpa" id="minimum_gpa" value="{{ old('minimum_gpa', '') }}" step="0.01" max="4">
                            @if($errors->has('minimum_gpa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('minimum_gpa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.minimum_gpa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="position_id">{{ trans('cruds.vacancy.fields.position') }}</label>
                            <select class="form-control select2" name="position_id" id="position_id">
                                @foreach($positions as $id => $entry)
                                    <option value="{{ $id }}" {{ old('position_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('position'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('position') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.position_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="industry_id">{{ trans('cruds.vacancy.fields.industry') }}</label>
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
                            <span class="help-block">{{ trans('cruds.vacancy.fields.industry_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="location_id">{{ trans('cruds.vacancy.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id">
                                @foreach($locations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="featured" value="0">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', 0) == 1 ? 'checked' : '' }}>
                                <label for="featured">{{ trans('cruds.vacancy.fields.featured') }}</label>
                            </div>
                            @if($errors->has('featured'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('featured') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vacancy.fields.featured_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.vacancies.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $vacancy->id ?? 0 }}');
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