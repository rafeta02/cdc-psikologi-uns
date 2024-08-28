@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resultCompetence.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.result-competences.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.resultCompetence.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultCompetence.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="competence_id">{{ trans('cruds.resultCompetence.fields.competence') }}</label>
                <select class="form-control select2 {{ $errors->has('competence') ? 'is-invalid' : '' }}" name="competence_id" id="competence_id">
                    @foreach($competences as $id => $entry)
                        <option value="{{ $id }}" {{ old('competence_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('competence'))
                    <span class="text-danger">{{ $errors->first('competence') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultCompetence.fields.competence_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="certificate">{{ trans('cruds.resultCompetence.fields.certificate') }}</label>
                <div class="needsclick dropzone {{ $errors->has('certificate') ? 'is-invalid' : '' }}" id="certificate-dropzone">
                </div>
                @if($errors->has('certificate'))
                    <span class="text-danger">{{ $errors->first('certificate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultCompetence.fields.certificate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.resultCompetence.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resultCompetence.fields.description_helper') }}</span>
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
    Dropzone.options.certificateDropzone = {
    url: '{{ route('admin.result-competences.storeMedia') }}',
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
      $('form').find('input[name="certificate"]').remove()
      $('form').append('<input type="hidden" name="certificate" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="certificate"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($resultCompetence) && $resultCompetence->certificate)
      var file = {!! json_encode($resultCompetence->certificate) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="certificate" value="' + file.file_name + '">')
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