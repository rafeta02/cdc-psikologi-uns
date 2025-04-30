@extends('layouts.frontend')

@section('title', 'Apply for ' . $magang->name . ' | ' . $magang->company->name)

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1 class="mb-3">Apply for Internship: {{ $magang->name }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('magang') }}">Magang/Internship</a></li>
                <li class="breadcrumb-item"><a href="{{ route('magang-detail', ['slug' => $magang->slug]) }}">{{ $magang->name }}</a></li>
                <li class="breadcrumb-item active">Apply</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9" style="margin-left: 12.5%;">
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
                    
                    <form action="{{ route('magang.store-application') }}" method="POST">
                        @csrf
                        <input type="hidden" name="magang_id" value="{{ $magang->id }}">
                        
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="nim">NIM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" required>
                            </div>
                            
                            <div class="col-lg-6 form-group">
                                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                            </div>
                            
                            <div class="col-lg-6 form-group">
                                <label for="semester">Semester <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" min="1" max="12" required>
                            </div>
                            
                            <div class="col-lg-6 form-group">
                                <label for="type">Type <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach(App\Models\MahasiswaMagang::TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-6 form-group">
                                <label for="bidang">Bidang <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="bidang" name="bidang" required>
                                    <option value="">Select Bidang</option>
                                    @foreach(App\Models\MahasiswaMagang::BIDANG_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('bidang') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-6 form-group">
                                <label for="instansi">Instansi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi', $magang->company->name) }}" required>
                            </div>
                            
                            <div class="col-lg-12 form-group">
                                <label for="alamat_instansi">Alamat Instansi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" rows="3" required>{{ old('alamat_instansi', $magang->company->location ?? '') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                            <a href="{{ route('magang-detail', ['slug' => $magang->slug]) }}" class="btn btn-default">Cancel</a>
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection 