@extends('layouts.frontend')

@section('title', 'Direct Internship Application')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1 class="mb-3">Direct Internship Application</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.mahasiswa-magangs.index') }}">My Applications</a></li>
                <li class="breadcrumb-item active">Direct Application</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Application Form</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route("frontend.mahasiswa-magangs.store") }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mahasiswa_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="approve" value="PENDING">
                        <input type="hidden" name="verified" value="PENDING">
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nim">NIM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', auth()->user()->identity_number ?? '') }}" required>
                                    @if($errors->has('nim'))
                                        <div class="text-danger">
                                            {{ $errors->first('nim') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', auth()->user()->name ?? '') }}" required>
                                    @if($errors->has('nama'))
                                        <div class="text-danger">
                                            {{ $errors->first('nama') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="semester">Semester <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" min="1" max="12" required>
                                    @if($errors->has('semester'))
                                        <div class="text-danger">
                                            {{ $errors->first('semester') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        @foreach(App\Models\MahasiswaMagang::TYPE_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                        <div class="text-danger">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bidang">Bidang <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="bidang" name="bidang" required>
                                        <option value="">Select Bidang</option>
                                        @foreach(App\Models\MahasiswaMagang::BIDANG_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('bidang') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bidang'))
                                        <div class="text-danger">
                                            {{ $errors->first('bidang') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="instansi">Instansi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi') }}" required>
                                    @if($errors->has('instansi'))
                                        <div class="text-danger">
                                            {{ $errors->first('instansi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="alamat_instansi">Alamat Instansi <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" rows="3" required>{{ old('alamat_instansi') }}</textarea>
                                    @if($errors->has('alamat_instansi'))
                                        <div class="text-danger">
                                            {{ $errors->first('alamat_instansi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                            <a href="{{ route('frontend.mahasiswa-magangs.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    Dropzone.options.berkasMagangDropzone = {
        url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
        maxFilesize: 10, // MB
        maxFiles: 5,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 10
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="berkas_magang[]" value="' + response.name + '">');
            uploadedBerkasMagangMap[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            var name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedBerkasMagangMap[file.name];
            }
            $('form').find('input[name="berkas_magang[]"][value="' + name + '"]').remove();
        },
        init: function () {
            @if(isset($mahasiswaMagang) && $mahasiswaMagang->berkas_magang)
                var files = {!! json_encode($mahasiswaMagang->berkas_magang) !!};
                for (var i in files) {
                    var file = files[i];
                    this.options.addedfile.call(this, file);
                    file.previewElement.classList.add('dz-complete');
                    $('form').append('<input type="hidden" name="berkas_magang[]" value="' + file.file_name + '">');
                }
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error');
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        }
    };
    
    var uploadedBerkasMagangMap = {};
</script>
@endsection