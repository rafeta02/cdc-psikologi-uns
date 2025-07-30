@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload Internship Documents</h3>
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
                        <i class="fas fa-info-circle"></i> Please upload the required documents for your internship application. Additional documents are optional but recommended.
                    </div>

                    <h5 class="mb-3">Required Documents</h5>

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

                        <hr class="my-4">
                        <h5 class="mb-3">Additional Documents (Optional)</h5>
                        <div class="alert alert-light">
                            <i class="fas fa-info-circle"></i> The following documents are optional. You can upload them now or later.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="khs">KHS (Kartu Hasil Studi)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="khs" name="khs" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="khs">Choose file (PDF, Word, or Image)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload your academic transcript</small>
                                    @if($mahasiswaMagang->khs)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->khs->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="krs">KRS (Kartu Rencana Studi)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="krs" name="krs" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="krs">Choose file (PDF, Word, or Image)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload your course plan</small>
                                    @if($mahasiswaMagang->krs)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->krs->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_persetujuan_dosen_pa">Form Persetujuan Dosen PA</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="form_persetujuan_dosen_pa" name="form_persetujuan_dosen_pa" accept=".pdf,.doc,.docx">
                                        <label class="custom-file-label" for="form_persetujuan_dosen_pa">Choose file (PDF or Word)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload academic advisor approval form</small>
                                    @if($mahasiswaMagang->form_persetujuan_dosen_pa)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surat_persetujuan_rekognisi">Surat Persetujuan Rekognisi</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="surat_persetujuan_rekognisi" name="surat_persetujuan_rekognisi" accept=".pdf,.doc,.docx">
                                        <label class="custom-file-label" for="surat_persetujuan_rekognisi">Choose file (PDF or Word)</label>
                                    </div>
                                    <small class="form-text text-muted">Upload recognition approval letter</small>
                                    @if($mahasiswaMagang->surat_persetujuan_rekognisi)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> View Current Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logbook_mbkm">Logbook MBKM</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logbook_mbkm" name="logbook_mbkm" accept=".pdf,.doc,.docx,.xls,.xlsx">
                                <label class="custom-file-label" for="logbook_mbkm">Choose file (PDF, Word, or Excel)</label>
                            </div>
                            <small class="form-text text-muted">Upload your MBKM activity logbook</small>
                            @if($mahasiswaMagang->logbook_mbkm)
                                <div class="mt-2">
                                    <a href="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file mr-1"></i> View Current Document
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

        // Add specific handling for the new document types
        $('#khs, #krs, #form_persetujuan_dosen_pa, #surat_persetujuan_rekognisi, #logbook_mbkm').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            let label = $(this).next('.custom-file-label');
            if (fileName) {
                label.addClass("selected").html(fileName);
            } else {
                label.removeClass("selected").html(label.attr('data-placeholder') || 'Choose file');
            }
        });
    });
</script>
@endsection 