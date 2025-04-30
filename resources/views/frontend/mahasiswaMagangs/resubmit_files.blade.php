@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Resubmit Internship Files</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.mahasiswa-magangs.index') }}">Internship Applications</a></li>
                <li class="breadcrumb-item active">Resubmit Files</li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resubmit Internship Files</h3>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-1"></i> Your internship application has been rejected. Please update your files and resubmit.
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Internship:</strong> {{ $mahasiswaMagang->magang->name ?? 'N/A' }}
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong> <span class="badge badge-danger">Rejected</span>
                    </div>

                    <form method="POST" action="{{ route('frontend.mahasiswa-magangs.update-files', [$mahasiswaMagang->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="berkas_magang"><strong>Internship Documents</strong></label>
                            <p class="text-muted">Please upload all required documents. Make sure they are clear and complete.</p>
                            <div class="needsclick dropzone" id="berkas_magang-dropzone">
                            </div>
                            @if($errors->has('berkas_magang'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('berkas_magang') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang_helper') }}</span>
                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-primary" type="submit">
                                Resubmit Application
                            </button>
                            <a class="btn btn-secondary" href="{{ route('frontend.mahasiswa-magangs.index') }}">
                                Cancel
                            </a>
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
    var uploadedBerkasMagangMap = {}
    Dropzone.options.berkasMagangDropzone = {
        url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
        maxFilesize: 50, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 50
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
                var files = {!! json_encode($mahasiswaMagang->berkas_magang) !!}
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