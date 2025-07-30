@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.dospem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dospems.update", [$dospem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nip">{{ trans('cruds.dospem.fields.nip') }}</label>
                <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', $dospem->nip) }}">
                @if($errors->has('nip'))
                    <span class="text-danger">{{ $errors->first('nip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dospem.fields.nip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama">{{ trans('cruds.dospem.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $dospem->nama) }}">
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dospem.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whatshapp">{{ trans('cruds.dospem.fields.whatshapp') }}</label>
                <input class="form-control {{ $errors->has('whatshapp') ? 'is-invalid' : '' }}" type="text" name="whatshapp" id="whatshapp" value="{{ old('whatshapp', $dospem->whatshapp) }}">
                @if($errors->has('whatshapp'))
                    <span class="text-danger">{{ $errors->first('whatshapp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dospem.fields.whatshapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.dospem.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dospem.fields.photo_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.dospems.storeMedia') }}',
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
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($dospem) && $dospem->photo)
      var file = {!! json_encode($dospem->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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