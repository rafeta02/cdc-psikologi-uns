@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload Final Internship Documents</h3>
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
                        <i class="fas fa-info-circle"></i> Please upload all required final documents for your internship.
                    </div>

                    <form action="{{ route('frontend.mahasiswa-magangs.store-final-documents', $mahasiswaMagang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="laporan_akhir">Final Report</label>
                                    <div class="needsclick dropzone" id="laporan_akhir-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload your final internship report</small>
                                    @if(count($mahasiswaMagang->laporan_akhir) > 0)
                                        <div class="mt-2">
                                            @foreach($mahasiswaMagang->laporan_akhir as $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1 mr-1">
                                                    <i class="fas fa-file-pdf mr-1"></i> {{ $media->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="presensi">Attendance Records</label>
                                    <div class="needsclick dropzone" id="presensi-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload your internship attendance records</small>
                                    @if(count($mahasiswaMagang->presensi) > 0)
                                        <div class="mt-2">
                                            @foreach($mahasiswaMagang->presensi as $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1 mr-1">
                                                    <i class="fas fa-file-pdf mr-1"></i> {{ $media->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sertifikat">Certificate</label>
                                    <div class="needsclick dropzone" id="sertifikat-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload your internship certificate</small>
                                    @if(count($mahasiswaMagang->sertifikat) > 0)
                                        <div class="mt-2">
                                            @foreach($mahasiswaMagang->sertifikat as $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1 mr-1">
                                                    <i class="fas fa-file-pdf mr-1"></i> {{ $media->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_penilaian_pembimbing_lapangan">Field Supervisor Evaluation Form</label>
                                    <div class="needsclick dropzone" id="form_penilaian_pembimbing_lapangan-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload evaluation form from field supervisor</small>
                                    @if($mahasiswaMagang->form_penilaian_pembimbing_lapangan)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> {{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_penilaian_dosen_pembimbing">Academic Supervisor Evaluation Form</label>
                                    <div class="needsclick dropzone" id="form_penilaian_dosen_pembimbing-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload evaluation form from academic supervisor</small>
                                    @if($mahasiswaMagang->form_penilaian_dosen_pembimbing)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> {{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="berita_acara_seminar">Seminar Minutes</label>
                                    <div class="needsclick dropzone" id="berita_acara_seminar-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload seminar minutes document</small>
                                    @if($mahasiswaMagang->berita_acara_seminar)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> {{ $mahasiswaMagang->berita_acara_seminar->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="presensi_kehadiran_seminar">Seminar Attendance</label>
                                    <div class="needsclick dropzone" id="presensi_kehadiran_seminar-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload seminar attendance records</small>
                                    @if(count($mahasiswaMagang->presensi_kehadiran_seminar) > 0)
                                        <div class="mt-2">
                                            @foreach($mahasiswaMagang->presensi_kehadiran_seminar as $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1 mr-1">
                                                    <i class="fas fa-file-pdf mr-1"></i> {{ $media->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notulen_pertanyaan">Question Notes</label>
                                    <div class="needsclick dropzone" id="notulen_pertanyaan-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload question notes document</small>
                                    @if($mahasiswaMagang->notulen_pertanyaan)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> {{ $mahasiswaMagang->notulen_pertanyaan->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanda_bukti_penyerahan_laporan">Report Submission Proof</label>
                                    <div class="needsclick dropzone" id="tanda_bukti_penyerahan_laporan-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload proof of report submission</small>
                                    @if($mahasiswaMagang->tanda_bukti_penyerahan_laporan)
                                        <div class="mt-2">
                                            <a href="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf mr-1"></i> {{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="berkas_magang">Other Internship Documents</label>
                                    <div class="needsclick dropzone" id="berkas_magang-dropzone">
                                    </div>
                                    <small class="form-text text-muted">Upload other supporting documents</small>
                                    @if(count($mahasiswaMagang->berkas_magang) > 0)
                                        <div class="mt-2">
                                            @foreach($mahasiswaMagang->berkas_magang as $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1 mr-1">
                                                    <i class="fas fa-file-pdf mr-1"></i> {{ $media->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Upload Documents</button>
                            <a href="{{ route('frontend.mahasiswa-magangs.index') }}" class="btn btn-secondary">Back</a>
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
    // Set up Dropzones for each file field
    const dropzoneFields = [
        'laporan_akhir', 
        'presensi', 
        'sertifikat',
        'form_penilaian_pembimbing_lapangan',
        'form_penilaian_dosen_pembimbing',
        'berita_acara_seminar',
        'presensi_kehadiran_seminar',
        'notulen_pertanyaan',
        'tanda_bukti_penyerahan_laporan',
        'berkas_magang'
    ];

    dropzoneFields.forEach(field => {
        const uploadMap = {};
        const multipleFiles = ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang'].includes(field);
        const inputName = multipleFiles ? `${field}[]` : field;
        
        const dropzone = new Dropzone(`#${field}-dropzone`, {
            url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
            maxFilesize: 10, // MB
            maxFiles: multipleFiles ? null : 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10
            },
            success: function (file, response) {
                $('form').append(`<input type="hidden" name="${inputName}" value="${response.name}">`);
                uploadMap[file.name] = response.name;
            },
            removedfile: function (file) {
                file.previewElement.remove();
                const name = typeof file.file_name !== 'undefined' ? file.file_name : uploadMap[file.name];
                $('form').find(`input[name="${inputName}"][value="${name}"]`).remove();
            },
            init: function () {
                @if(isset($mahasiswaMagang))
                    @if(multipleFiles)
                        @if(count($mahasiswaMagang->$field) > 0)
                            var files = {!! json_encode($mahasiswaMagang->$field) !!};
                            for (var i in files) {
                                var file = files[i];
                                this.options.addedfile.call(this, file);
                                this.options.thumbnail.call(this, file, file.preview ?? file.url);
                                file.previewElement.classList.add('dz-complete');
                                $('form').append(`<input type="hidden" name="${inputName}" value="${file.file_name}">`);
                            }
                        @endif
                    @else
                        @if($mahasiswaMagang->$field)
                            var file = {!! json_encode($mahasiswaMagang->$field) !!};
                            this.options.addedfile.call(this, file);
                            this.options.thumbnail.call(this, file, file.preview ?? file.url);
                            file.previewElement.classList.add('dz-complete');
                            $('form').append(`<input type="hidden" name="${inputName}" value="${file.file_name}">`);
                        @endif
                    @endif
                @endif
            },
            error: function (file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
                var _results = [];
                for (var _i = 0, _len = _ref.length; _i < _len; _i++) {
                    var node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        });
    });
</script>
@endsection 