@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vacancy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vacancies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.vacancy.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="required" for="company_id">{{ trans('cruds.vacancy.fields.company') }}</label>
                        <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                            @foreach($companies as $id => $entry)
                                <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                            <option>ADD NEW COMPANY</option>
                        </select>
                        @if($errors->has('company'))
                            <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.company_helper') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.vacancy.fields.description') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.description_helper') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="close_date_exist">Close Date Exist ?</label>
                        <div class="form-check {{ $errors->has('close_date_exist') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="close_date_exist" value="0">
                            <input class="form-check-input" type="checkbox" name="close_date_exist" id="close_date_exist" value="1" {{ old('close_date_exist', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="close_date_exist">Exist</label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="required" for="open_date">{{ trans('cruds.vacancy.fields.open_date') }}</label>
                        <input class="form-control date {{ $errors->has('open_date') ? 'is-invalid' : '' }}" type="text" name="open_date" id="open_date" value="{{ old('open_date') }}">
                        @if($errors->has('open_date'))
                            <span class="text-danger">{{ $errors->first('open_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.open_date_helper') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="required" for="close_date">{{ trans('cruds.vacancy.fields.close_date') }}</label>
                        <input class="form-control date {{ $errors->has('close_date') ? 'is-invalid' : '' }}" type="text" name="close_date" id="close_date" value="{{ old('close_date') }}">
                        @if($errors->has('close_date'))
                            <span class="text-danger">{{ $errors->first('close_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.close_date_helper') }}</span>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for="persyaratan_umum">Requirement</label>
                        <textarea class="form-control ckeditor {{ $errors->has('persyaratan_umum') ? 'is-invalid' : '' }}" name="persyaratan_umum" id="persyaratan_umum">{!! old('persyaratan_umum') !!}</textarea>
                        @if($errors->has('persyaratan_umum'))
                            <span class="text-danger">{{ $errors->first('persyaratan_umum') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.persyaratan_umum_helper') }}</span>
                    </div>
                </div> --}}
                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for="persyaratan_khusus">{{ trans('cruds.vacancy.fields.persyaratan_khusus') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('persyaratan_khusus') ? 'is-invalid' : '' }}" name="persyaratan_khusus" id="persyaratan_khusus">{!! old('persyaratan_khusus') !!}</textarea>
                        @if($errors->has('persyaratan_khusus'))
                            <span class="text-danger">{{ $errors->first('persyaratan_khusus') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.persyaratan_khusus_helper') }}</span>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="form-group">
                        <label for="job_description">Description</label>
                        <textarea class="form-control ckeditor {{ $errors->has('job_description') ? 'is-invalid' : '' }}" name="job_description" id="job_description">{!! old('job_description') !!}</textarea>
                        @if($errors->has('job_description'))
                            <span class="text-danger">{{ $errors->first('job_description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.job_description_helper') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="registration">How To Apply</label>
                        <textarea class="form-control ckeditor {{ $errors->has('registration') ? 'is-invalid' : '' }}" name="registration" id="registration">{!! old('registration') !!}</textarea>
                        @if($errors->has('registration'))
                            <span class="text-danger">{{ $errors->first('registration') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.registration_helper') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.vacancy.fields.type') }}</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Vacancy::TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.type_helper') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="required" for="position_id">{{ trans('cruds.vacancy.fields.position') }}</label>
                        <select class="form-control select2 {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position_id" id="position_id">
                            @foreach($positions as $id => $entry)
                                <option value="{{ $id }}" {{ old('position_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.vacancy.fields.position_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="location_id">{{ trans('cruds.vacancy.fields.location') }}</label>
                <select class="select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id[]" id="location_id" multiple>
                    {{-- @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach --}}
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="experience_id">{{ trans('cruds.vacancy.fields.experience') }}</label>
                <select class="form-control select2 {{ $errors->has('experience') ? 'is-invalid' : '' }}" name="experience_id" id="experience_id" required>
                    @foreach($experiences as $id => $entry)
                        <option value="{{ $id }}" {{ old('experience_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('experience'))
                    <span class="text-danger">{{ $errors->first('experience') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.vacancy.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="education">{{ trans('cruds.vacancy.fields.education') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('education') ? 'is-invalid' : '' }}" name="education[]" id="education" multiple>
                    @foreach($education as $id => $education)
                        <option value="{{ $id }}" {{ in_array($id, old('education', [])) ? 'selected' : '' }}>{{ $education }}</option>
                    @endforeach
                </select>
                @if($errors->has('education'))
                    <span class="text-danger">{{ $errors->first('education') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.education_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departments">{{ trans('cruds.vacancy.fields.department') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('departments') ? 'is-invalid' : '' }}" name="departments[]" id="departments" multiple>
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ in_array($id, old('departments', [])) ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('departments'))
                    <span class="text-danger">{{ $errors->first('departments') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.department_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="minimum_gpa">{{ trans('cruds.vacancy.fields.minimum_gpa') }}</label>
                <input class="form-control {{ $errors->has('minimum_gpa') ? 'is-invalid' : '' }}" type="number" name="minimum_gpa" id="minimum_gpa" value="{{ old('minimum_gpa', '') }}" step="0.01" max="4">
                @if($errors->has('minimum_gpa'))
                    <span class="text-danger">{{ $errors->first('minimum_gpa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vacancy.fields.minimum_gpa_helper') }}</span>
            </div> --}}
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
                xhr.open('POST', '{{ route('admin.vacancies.storeCKEditorImages') }}', true);
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

    $('#company_id').select2({
        matcher: function(params, data) {
            // Always return the pinned option
            if (data.text === 'ADD NEW COMPANY') {
                return data;
            }
            // If there is no search term, show all options
            if ($.trim(params.term) === '') {
                return data;
            }
            // Check if the option or text matches the search term
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                return data;
            }
            // If it doesn't match, return `null`
            return null;
        }
    });

    $('#company_id').on('select2:select', function (e) {
        var selectedValue = e.params.data.text;
        if (selectedValue === 'ADD NEW COMPANY') {
            window.open('{{ route("admin.companies.create") }}', '_blank');
        }
    });

    $('#position_id').select2({
        tags: true,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newOption: true
            };
        }
    });

    $('#position_id').on('select2:select', function(e) {
        var data = e.params.data;
        if (data.newOption) {
            $('#loadingSpinner').show(); // Show the loading spinner
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.positions.storeSelect") }}',
                data: {
                    text: data.text,
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                    var newOption = new Option(response.text, response.id, false, false);
                    $('#position_id').append(newOption).trigger('change');
                    $('#position_id').val(response.id).trigger('change');
                    $('#loadingSpinner').hide(); // Hide the loading spinner on success
                },
                error: function(xhr) {
                    console.error('AJAX POST error:', xhr.responseText); // Log the error to the console
                    $('#loadingSpinner').hide(); // Hide the loading spinner on error
                }
            });
        }
    });

    $('#location_id').select2({
        placeholder: 'Search for a location',
        ajax: {
            url: '{{ route("admin.provinces.getProvincesWithRegencies") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 3 // minimum chars to search
    });
});
</script>

<script>
$(function () {
    var openDateInitialized = false;
    var closeDateInitialized = false;

    $('#open_date').datetimepicker().on('dp.change', function (e) {
        if (!openDateInitialized) {
            openDateInitialized = true;
            return;
        }
        $('#close_date').data('DateTimePicker').minDate(e.date);

        if (!$('#close_date_exist').is(':checked')) {
            // Automatically set close_date to 2 months after open_date
            var twoMonthsAfter = e.date.clone().add(2, 'months');
            $('#close_date').data('DateTimePicker').date(twoMonthsAfter);
        }
    });

    $('#close_date').datetimepicker().on('dp.change', function (e) {
        if (!closeDateInitialized) {
            closeDateInitialized = true;
            return;
        }
        $('#open_date').data('DateTimePicker').maxDate(e.date);
    });
});
</script>
@endsection
