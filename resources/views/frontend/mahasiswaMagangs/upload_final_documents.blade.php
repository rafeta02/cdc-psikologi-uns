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

                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <strong>Congratulations!</strong> You have completed the posttest and can now upload your final documents.
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Please upload all required final documents for your internship completion.
                    </div>

                    <!-- Progress Indicator -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-muted">Internship Progress:</h6>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    90% Complete - Final Documents Stage
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block">
                                ✅ Pretest Completed | ✅ Monitoring Reports | ✅ Posttest Completed | 📋 Final Documents (Current Stage)
                            </small>
                        </div>
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
        { name: 'laporan_akhir', multiple: true }, 
        { name: 'presensi', multiple: true }, 
        { name: 'sertifikat', multiple: true },
        { name: 'form_penilaian_pembimbing_lapangan', multiple: false },
        { name: 'form_penilaian_dosen_pembimbing', multiple: false },
        { name: 'berita_acara_seminar', multiple: false },
        { name: 'presensi_kehadiran_seminar', multiple: true },
        { name: 'notulen_pertanyaan', multiple: false },
        { name: 'tanda_bukti_penyerahan_laporan', multiple: false },
        { name: 'berkas_magang', multiple: true }
    ];

    dropzoneFields.forEach(fieldConfig => {
        const field = fieldConfig.name;
        const multipleFiles = fieldConfig.multiple;
        const uploadMap = {};
        const inputName = multipleFiles ? `${field}[]` : field;
        
        const dropzone = new Dropzone(`#${field}-dropzone`, {
            url: '{{ route('frontend.mahasiswa-magangs.storeMedia') }}',
            maxFilesize: 10, // MB
            maxFiles: multipleFiles ? null : 1,
            addRemoveLinks: true,
            acceptedFiles: field === 'form_penilaian_pembimbing_lapangan' || field === 'form_penilaian_dosen_pembimbing' || field === 'logbook_mbkm' 
                ? '.pdf,.doc,.docx,.xls,.xlsx' 
                : field === 'khs' || field === 'krs'
                ? '.pdf,.doc,.docx,.jpg,.jpeg,.png'
                : '.pdf,.doc,.docx',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                collection: field,
                nim: '{{ $mahasiswaMagang->nim ?? "unknown" }}'
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
                    // Handle multiple files fields
                    if (multipleFiles) {
                        var files = null;
                        @if(in_array('laporan_akhir', ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang']))
                            if (field === 'laporan_akhir' && {!! count($mahasiswaMagang->laporan_akhir ?? []) !!} > 0) {
                                files = {!! json_encode($mahasiswaMagang->laporan_akhir ?? []) !!};
                            }
                        @endif
                        @if(in_array('presensi', ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang']))
                            if (field === 'presensi' && {!! count($mahasiswaMagang->presensi ?? []) !!} > 0) {
                                files = {!! json_encode($mahasiswaMagang->presensi ?? []) !!};
                            }
                        @endif
                        @if(in_array('sertifikat', ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang']))
                            if (field === 'sertifikat' && {!! count($mahasiswaMagang->sertifikat ?? []) !!} > 0) {
                                files = {!! json_encode($mahasiswaMagang->sertifikat ?? []) !!};
                            }
                        @endif
                        @if(in_array('presensi_kehadiran_seminar', ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang']))
                            if (field === 'presensi_kehadiran_seminar' && {!! count($mahasiswaMagang->presensi_kehadiran_seminar ?? []) !!} > 0) {
                                files = {!! json_encode($mahasiswaMagang->presensi_kehadiran_seminar ?? []) !!};
                            }
                        @endif
                        @if(in_array('berkas_magang', ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang']))
                            if (field === 'berkas_magang' && {!! count($mahasiswaMagang->berkas_magang ?? []) !!} > 0) {
                                files = {!! json_encode($mahasiswaMagang->berkas_magang ?? []) !!};
                            }
                        @endif
                        
                        if (files) {
                            for (var i in files) {
                                var file = files[i];
                                this.options.addedfile.call(this, file);
                                this.options.thumbnail.call(this, file, file.preview ?? file.url);
                                file.previewElement.classList.add('dz-complete');
                                $('form').append(`<input type="hidden" name="${inputName}" value="${file.file_name}">`);
                            }
                        }
                    } else {
                        // Handle single file fields
                        var file = null;
                        if (field === 'form_penilaian_pembimbing_lapangan' && {!! $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'true' : 'false' !!}) {
                            file = {!! json_encode($mahasiswaMagang->form_penilaian_pembimbing_lapangan ?? null) !!};
                        }
                        if (field === 'form_penilaian_dosen_pembimbing' && {!! $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'true' : 'false' !!}) {
                            file = {!! json_encode($mahasiswaMagang->form_penilaian_dosen_pembimbing ?? null) !!};
                        }
                        if (field === 'berita_acara_seminar' && {!! $mahasiswaMagang->berita_acara_seminar ? 'true' : 'false' !!}) {
                            file = {!! json_encode($mahasiswaMagang->berita_acara_seminar ?? null) !!};
                        }
                        if (field === 'notulen_pertanyaan' && {!! $mahasiswaMagang->notulen_pertanyaan ? 'true' : 'false' !!}) {
                            file = {!! json_encode($mahasiswaMagang->notulen_pertanyaan ?? null) !!};
                        }
                        if (field === 'tanda_bukti_penyerahan_laporan' && {!! $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'true' : 'false' !!}) {
                            file = {!! json_encode($mahasiswaMagang->tanda_bukti_penyerahan_laporan ?? null) !!};
                        }
                        
                        if (file) {
                            this.options.addedfile.call(this, file);
                            this.options.thumbnail.call(this, file, file.preview ?? file.url);
                            file.previewElement.classList.add('dz-complete');
                            $('form').append(`<input type="hidden" name="${inputName}" value="${file.file_name}">`);
                        }
                    }
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