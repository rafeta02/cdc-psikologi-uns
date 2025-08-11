@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h3>Internship Application Details</h3>
                <h4 class="text-muted">{{ $mahasiswaMagang->nama }} ({{ $mahasiswaMagang->nim }})</h4>
    </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-default" href="{{ route('admin.mahasiswa-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <a class="btn btn-info" href="{{ route('admin.mahasiswa-magangs.verify-documents', $mahasiswaMagang->id) }}">
                    <i class="fa fa-check-circle"></i> Verify Documents
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <!-- Student & Internship Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Student & Internship Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                <tbody>
                    <tr>
                                    <th width="35%">Student</th>
                                    <td>{{ $mahasiswaMagang->mahasiswa->name ?? '' }}</td>
                    </tr>
                    <tr>
                                    <th>NIM</th>
                                    <td>{{ $mahasiswaMagang->nim }}</td>
                    </tr>
                    <tr>
                                    <th>Name</th>
                                    <td>{{ $mahasiswaMagang->nama }}</td>
                    </tr>
                    <tr>
                                    <th>Semester</th>
                                    <td>{{ $mahasiswaMagang->semester }}</td>
                    </tr>
                    <tr>
                                    <th>Type</th>
                        <td>
                                        <span class="badge badge-info">
                            {{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? '' }}
                                        </span>
                        </td>
                    </tr>
                    <tr>
                                    <th>Field</th>
                        <td>
                                        <span class="badge badge-secondary">
                            {{ App\Models\MahasiswaMagang::BIDANG_SELECT[$mahasiswaMagang->bidang] ?? '' }}
                                        </span>
                        </td>
                    </tr>
                    <tr>
                                    <th>Institution</th>
                                    <td>{{ $mahasiswaMagang->instansi }}</td>
                                </tr>
                                <tr>
                                    <th>Institution Address</th>
                                    <td>{{ $mahasiswaMagang->alamat_instansi }}</td>
                                </tr>
                                @if($mahasiswaMagang->company)
                                <tr>
                                    <th>Company</th>
                                    <td>{{ $mahasiswaMagang->company->name ?? '' }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Academic Supervisor</th>
                                    <td>{{ $mahasiswaMagang->dospem->nama ?? $mahasiswaMagang->dosen_pembimbing ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Status & Approval Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Status & Approval Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="35%">Application Status</th>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'APPROVED' => 'success',
                                                'PENDING' => 'warning', 
                                                'REJECTED' => 'danger'
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $statusClass[$mahasiswaMagang->approve] ?? 'secondary' }}">
                                            {{ App\Models\MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] ?? '' }}
                                        </span>
                        </td>
                    </tr>
                    <tr>
                                    <th>Approved By</th>
                                    <td>{{ $mahasiswaMagang->approved_by->name ?? 'Not approved yet' }}</td>
                                </tr>
                                @if($mahasiswaMagang->approval_notes)
                                <tr>
                                    <th>Approval Notes</th>
                                    <td>
                                        <div class="p-2 bg-light border rounded">
                                            {{ $mahasiswaMagang->approval_notes }}
                                        </div>
                        </td>
                    </tr>
                                @endif
                    <tr>
                                    <th>Verification Status</th>
                        <td>
                                        <span class="badge badge-{{ $statusClass[$mahasiswaMagang->verified] ?? 'secondary' }}">
                                            {{ App\Models\MahasiswaMagang::VERIFIED_SELECT[$mahasiswaMagang->verified] ?? '' }}
                                        </span>
                        </td>
                    </tr>
                    <tr>
                                    <th>Verified By</th>
                                    <td>{{ $mahasiswaMagang->verified_by->name ?? 'Not verified yet' }}</td>
                                </tr>
                                @if($mahasiswaMagang->verification_notes)
                                <tr>
                                    <th>Verification Notes</th>
                                    <td>
                                        <div class="p-2 bg-light border rounded">
                                            {{ $mahasiswaMagang->verification_notes }}
                                        </div>
                        </td>
                    </tr>
                                @endif
                                <tr>
                                    <th>Application Date</th>
                                    <td>{{ $mahasiswaMagang->formatDate('created_at', 'd F Y, H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Information Section -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Test Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pre-Test</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Status:</span>
                                    <span class="badge {{ $mahasiswaMagang->pretest ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $mahasiswaMagang->pretest ? 'Completed' : 'Pending' }}
                                    </span>
                                </div>
                                                            @if($mahasiswaMagang->pretest_completed_at)
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span>Completed:</span>
                                <span>{{ $mahasiswaMagang->formatDate('pretest_completed_at') }}</span>
                            </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Post-Test</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Status:</span>
                                    <span class="badge {{ $mahasiswaMagang->posttest ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $mahasiswaMagang->posttest ? 'Completed' : 'Pending' }}
                                    </span>
                                </div>
                                                            @if($mahasiswaMagang->posttest_completed_at)
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span>Completed:</span>
                                <span>{{ $mahasiswaMagang->formatDate('posttest_completed_at') }}</span>
                            </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monitoring/Guidance Section -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Monitoring & Guidance Sessions</h4>
            </div>
            <div class="card-body">
                @if($mahasiswaMagang->monitorings && $mahasiswaMagang->monitorings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Place</th>
                                    <th>Supervisor</th>
                                    <th>Results</th>
                                    <th>Evidence</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswaMagang->monitorings as $monitoring)
                                <tr>
                                    <td>{{ $monitoring->tanggal }}</td>
                                    <td>{{ $monitoring->tempat }}</td>
                                    <td>{{ $monitoring->pembimbing }}</td>
                                    <td>
                                        <div style="max-width: 200px;">
                                            {{ Str::limit($monitoring->hasil, 100) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($monitoring->bukti && count($monitoring->bukti) > 0)
                                            @foreach($monitoring->bukti as $media)
                                                <button type="button" class="btn btn-sm btn-info mb-1 embed-pdf-btn" 
                                                        data-title="Evidence {{ $loop->iteration }}" 
                                                        data-url="{{ $media->getUrl() }}">
                                                    <i class="fa fa-file"></i> View {{ $loop->iteration }}
                                                </button>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No evidence</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.monitoring-magangs.show', $monitoring->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                        </td>
                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> No monitoring sessions recorded yet.
                    </div>
                @endif
            </div>
        </div>

        <!-- Required Documents Section -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Required Documents</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="30%">Document Type</th>
                                <th width="15%">Status</th>
                                <th width="55%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KHS</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->khs ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->khs ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->khs)
                                        <a href="{{ $mahasiswaMagang->khs->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="KHS" data-url="{{ $mahasiswaMagang->khs->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>KRS</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->krs ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->krs ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->krs)
                                        <a href="{{ $mahasiswaMagang->krs->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="KRS" data-url="{{ $mahasiswaMagang->krs->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Form Persetujuan Dosen PA</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_persetujuan_dosen_pa ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_persetujuan_dosen_pa ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->form_persetujuan_dosen_pa)
                                        <a href="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Persetujuan Dosen PA" data-url="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Persetujuan Rekognisi</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->surat_persetujuan_rekognisi ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->surat_persetujuan_rekognisi ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->surat_persetujuan_rekognisi)
                                        <a href="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Surat Persetujuan Rekognisi" data-url="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Logbook MBKM</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->logbook_mbkm ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->logbook_mbkm ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->logbook_mbkm)
                                        <a href="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Logbook MBKM" data-url="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Berkas Magang Lainnya</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->berkas_magang) > 0 ? 'badge-success' : 'badge-secondary' }}">
                                        {{ count($mahasiswaMagang->berkas_magang) > 0 ? 'Uploaded' : 'Optional' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->berkas_magang) > 0)
                                        @foreach($mahasiswaMagang->berkas_magang as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Berkas Magang {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                            @endforeach
                                    @else
                                        <span class="text-muted">No additional documents</span>
                                    @endif
                        </td>
                    </tr>
                            <tr>
                                <td>Proposal Magang</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->proposal_magang ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->proposal_magang ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->proposal_magang)
                                        <a href="{{ $mahasiswaMagang->proposal_magang->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Proposal Magang" data-url="{{ $mahasiswaMagang->proposal_magang->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Surat Tugas</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->surat_tugas ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->surat_tugas ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->surat_tugas)
                                        <a href="{{ $mahasiswaMagang->surat_tugas->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Surat Tugas" data-url="{{ $mahasiswaMagang->surat_tugas->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Berkas Instansi</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->berkas_instansi ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->berkas_instansi ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->berkas_instansi)
                                        <a href="{{ $mahasiswaMagang->berkas_instansi->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Berkas Instansi" data-url="{{ $mahasiswaMagang->berkas_instansi->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Laporan Akhir</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->laporan_akhir) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->laporan_akhir) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->laporan_akhir) > 0)
                                        @foreach($mahasiswaMagang->laporan_akhir as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Laporan Akhir {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                            @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Presensi</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->presensi) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->presensi) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->presensi) > 0)
                                        @foreach($mahasiswaMagang->presensi as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Presensi {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                            @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Sertifikat</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->sertifikat) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->sertifikat) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->sertifikat) > 0)
                                        @foreach($mahasiswaMagang->sertifikat as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Sertifikat {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                            @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Form Penilaian Pembimbing Lapangan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                        <td>
                            @if($mahasiswaMagang->form_penilaian_pembimbing_lapangan)
                                        <a href="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Penilaian Pembimbing Lapangan" data-url="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Form Penilaian Dosen Pembimbing</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                        <td>
                            @if($mahasiswaMagang->form_penilaian_dosen_pembimbing)
                                        <a href="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Penilaian Dosen Pembimbing" data-url="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Berita Acara Seminar</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->berita_acara_seminar ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->berita_acara_seminar ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                        <td>
                            @if($mahasiswaMagang->berita_acara_seminar)
                                        <a href="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Berita Acara Seminar" data-url="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Presensi Kehadiran Seminar</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->presensi_kehadiran_seminar) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->presensi_kehadiran_seminar) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->presensi_kehadiran_seminar) > 0)
                                        @foreach($mahasiswaMagang->presensi_kehadiran_seminar as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Presensi Kehadiran Seminar {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                            @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Notulen Pertanyaan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->notulen_pertanyaan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->notulen_pertanyaan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                        <td>
                            @if($mahasiswaMagang->notulen_pertanyaan)
                                        <a href="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Notulen Pertanyaan" data-url="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                                <td>Tanda Bukti Penyerahan Laporan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                        <td>
                            @if($mahasiswaMagang->tanda_bukti_penyerahan_laporan)
                                        <a href="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Tanda Bukti Penyerahan Laporan" data-url="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                            @endif
                        </td>
                    </tr>
                    
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDF Preview Modal -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" role="dialog" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfPreviewModalLabel">Document Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" width="100%" height="600" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="pdfDownloadBtn" href="#" target="_blank" class="btn btn-primary">Open in New Tab</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Handle PDF preview
        $('.embed-pdf-btn').on('click', function() {
            var title = $(this).data('title');
            var url = $(this).data('url');
            
            $('#pdfPreviewModalLabel').text(title);
            $('#pdfFrame').attr('src', url);
            $('#pdfDownloadBtn').attr('href', url);
            $('#pdfPreviewModal').modal('show');
        });
    });
</script>
@endsection