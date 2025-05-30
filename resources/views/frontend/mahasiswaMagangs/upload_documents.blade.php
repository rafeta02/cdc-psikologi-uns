@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload Required Documents</h3>
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

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Please upload the following required documents for your internship application.
                    </div>

                    <form action="{{ route('frontend.mahasiswa-magangs.store-documents', $mahasiswaMagang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="proposal_magang">Proposal Magang <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="proposal_magang" name="proposal_magang" accept=".pdf,.doc,.docx">
                                        <label class="custom-file-label" for="proposal_magang">Choose file (PDF or Word)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload your internship proposal document</small>
                                    @if($mahasiswaMagang->proposal_magang)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->proposal_magang->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surat_tugas">Surat Tugas <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="surat_tugas" name="surat_tugas" accept=".pdf,.doc,.docx">
                                        <label class="custom-file-label" for="surat_tugas">Choose file (PDF or Word)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload your assignment letter</small>
                                    @if($mahasiswaMagang->surat_tugas)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->surat_tugas->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="berkas_instansi">Berkas Instansi <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="berkas_instansi" name="berkas_instansi" accept=".pdf,.doc,.docx">
                                <label class="custom-file-label" for="berkas_instansi">Choose file (PDF or Word)</label>
                            </div>
                            <small class="form-text text-muted">Upload institution supporting documents</small>
                            @if($mahasiswaMagang->berkas_instansi)
                                <div class="mt-2">
                                    <a href="{{ $mahasiswaMagang->berkas_instansi->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf mr-1"></i> View Current Document
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Upload Documents</button>
                            <a href="{{ route('frontend.mahasiswa-magangs.index') }}" class="btn btn-secondary">Cancel</a>
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
    $(document).ready(function () {
        // Update custom file input labels with selected filename
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection 