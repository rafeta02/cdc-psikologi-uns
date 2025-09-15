@extends('layouts.frontend')

@section('title', 'Detail Magang Application - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Magang Application Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.mahasiswa-magangs.index') }}">My Applications</a></li>
                <li class="breadcrumb-item active">Application Details</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>My Internship Application</h3>
                            <h4 class="text-muted">{{ $mahasiswaMagang->nama }} ({{ $mahasiswaMagang->nim }})</h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <a class="btn btn-default" href="{{ route('frontend.mahasiswa-magangs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Status Alert -->
                    @if($mahasiswaMagang->verification_notes)
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Verification Notes</h5>
                        {{ $mahasiswaMagang->verification_notes }}
                    </div>
                    @endif

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

                        <!-- Status Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h4 class="mb-0">Application Status</h4>
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
                                                <td>{{ $mahasiswaMagang->approved_by->name ?? 'Pending approval' }}</td>
                                            </tr>
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
                                                <td>{{ $mahasiswaMagang->verified_by->name ?? 'Pending verification' }}</td>
                                            </tr>
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

                    <!-- Assessment Tests Section -->
                    @if(auth()->user()->id == $mahasiswaMagang->mahasiswa_id)
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">Assessment Tests</h4>
                        </div>
                        <div class="card-body">
                            @if($mahasiswaMagang->approve !== 'APPROVED')
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Tests will be available after your application is approved by admin.
                                </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            Pre-Test
                                        </div>
                                        <div class="card-body">
                                            <p>Ujian sebelum memulai program magang untuk mengukur kesiapan adaptasi Anda.</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span>Status:</span>
                                                <span class="badge {{ $mahasiswaMagang->pretest ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $mahasiswaMagang->pretest ? 'Completed' : 'Pending' }}
                                                </span>
                                            </div>
                                                                        @if($mahasiswaMagang->pretest_completed_at)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Completed:</span>
                                <span>{{ $mahasiswaMagang->formatDate('pretest_completed_at') }}</span>
                            </div>
                            @endif
                                            @if($mahasiswaMagang->pretest)
                                                <button class="btn btn-success btn-block" disabled>
                                                    <i class="fas fa-check"></i> Completed
                                                </button>
                                            @elseif($mahasiswaMagang->approve !== 'APPROVED')
                                                <button class="btn btn-secondary btn-block" disabled title="Application must be approved first">
                                                    <i class="fas fa-lock mr-1"></i> Pre-Test (Locked)
                                                </button>
                                            @else
                                                <a href="{{ route('frontend.mahasiswa-magangs.take-test', ['magang_id' => $mahasiswaMagang->id, 'type' => 'PRETEST']) }}" 
                                                   class="btn btn-primary btn-block">
                                                    Take Pre-Test
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-secondary text-white">
                                            Post-Test
                                        </div>
                                        <div class="card-body">
                                            <p>Ujian setelah menyelesaikan program magang untuk mengukur perkembangan Anda.</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span>Status:</span>
                                                <span class="badge {{ $mahasiswaMagang->posttest ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $mahasiswaMagang->posttest ? 'Completed' : 'Pending' }}
                                                </span>
                                            </div>
                                                                        @if($mahasiswaMagang->posttest_completed_at)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Completed:</span>
                                <span>{{ $mahasiswaMagang->formatDate('posttest_completed_at') }}</span>
                            </div>
                            @endif
                                            @if($mahasiswaMagang->posttest)
                                                <button class="btn btn-success btn-block" disabled>
                                                    <i class="fas fa-check"></i> Completed
                                                </button>
                                            @elseif(!$mahasiswaMagang->pretest)
                                                <button class="btn btn-secondary btn-block" disabled>
                                                    Complete Pre-Test First
                                                </button>
                                            @elseif($mahasiswaMagang->approve != 'APPROVED')
                                                <button class="btn btn-secondary btn-block" disabled title="Application must be approved first">
                                                    <i class="fas fa-lock mr-1"></i> Post-Test (Locked)
                                                </button>
                                            @else
                                                <a href="{{ route('frontend.mahasiswa-magangs.take-test', ['magang_id' => $mahasiswaMagang->id, 'type' => 'POSTTEST']) }}" 
                                                   class="btn btn-info btn-block">
                                                    Take Post-Test
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Monitoring Section -->
                    @if($mahasiswaMagang->mahasiswa_id == auth()->id() && $mahasiswaMagang->approve == 'APPROVED')
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h4 class="mb-0 d-inline">Monitoring & Guidance Sessions</h4>
                            <a href="{{ route('frontend.monitoring-magangs.create', ['magang_id' => $mahasiswaMagang->id]) }}" class="btn btn-sm btn-success float-right">
                                <i class="fa fa-plus"></i> Add Monitoring
                            </a>
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
                                                <td>{{ $monitoring->dospem->nama ?? $monitoring->pembimbing ?? '' }}</td>
                                                <td>
                                                    <div style="max-width: 200px;">
                                                        {{ Str::limit($monitoring->hasil, 100) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($monitoring->bukti && count($monitoring->bukti) > 0)
                                                        @foreach($monitoring->bukti as $media)
                                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-xs btn-info mb-1">
                                                                <i class="fa fa-file"></i> {{ $loop->iteration }}
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">No evidence</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('frontend.monitoring-magangs.show', $monitoring->id) }}" class="btn btn-xs btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('frontend.monitoring-magangs.edit', $monitoring->id) }}" class="btn btn-xs btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> No monitoring sessions recorded yet. <a href="{{ route('frontend.monitoring-magangs.create', ['magang_id' => $mahasiswaMagang->id]) }}">Add your first monitoring session</a>.
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Document Status Summary -->
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Document Status Summary</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $documents = [
                                    'Proposal Magang' => $mahasiswaMagang->proposal_magang,
                                    'Surat Tugas' => $mahasiswaMagang->surat_tugas,
                                    'Berkas Instansi' => $mahasiswaMagang->berkas_instansi,
                                    'Laporan Akhir' => count($mahasiswaMagang->laporan_akhir) > 0,
                                    'Presensi' => count($mahasiswaMagang->presensi) > 0,
                                    'Sertifikat' => count($mahasiswaMagang->sertifikat) > 0,
                                    'Form Penilaian Pembimbing Lapangan' => $mahasiswaMagang->form_penilaian_pembimbing_lapangan,
                                    'Form Penilaian Dosen Pembimbing' => $mahasiswaMagang->form_penilaian_dosen_pembimbing,
                                    'Berita Acara Seminar' => $mahasiswaMagang->berita_acara_seminar,
                                    'Presensi Kehadiran Seminar' => count($mahasiswaMagang->presensi_kehadiran_seminar) > 0,
                                    'Notulen Pertanyaan' => $mahasiswaMagang->notulen_pertanyaan,
                                    'Tanda Bukti Penyerahan Laporan' => $mahasiswaMagang->tanda_bukti_penyerahan_laporan,
                                ];
                                $completed = collect($documents)->filter()->count();
                                $total = count($documents);
                                $percentage = ($completed / $total) * 100;
                            @endphp
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-file-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Documents</span>
                                            <span class="info-box-number">{{ $total }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Completed</span>
                                            <span class="info-box-number">{{ $completed }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-clock"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Pending</span>
                                            <span class="info-box-number">{{ $total - $completed }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-percentage"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Progress</span>
                                            <span class="info-box-number">{{ number_format($percentage, 1) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($percentage, 1) }}%
                                </div>
                            </div>

                            <div class="row">
                                @foreach($documents as $docName => $isUploaded)
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa {{ $isUploaded ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} mr-2"></i>
                                        <span class="{{ $isUploaded ? 'text-success' : 'text-danger' }}">{{ $docName }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
@parent
<style>
.info-box {
    display: block;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}
.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
}
.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}
.info-box-text {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 13px;
}
.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}
</style>
@endsection