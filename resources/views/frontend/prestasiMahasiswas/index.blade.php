@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Prestasi Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Prestasi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<style>
    .prestasi-card {
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }
    .prestasi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.125);
        padding: 0.75rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-badge {
        font-size: 85%;
        padding: 0.25em 0.5em;
        margin-right: 0.25rem;
    }
    .btn-action-icon {
        width: 30px;
        height: 30px;
        padding: 0;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
    }
    .card-footer-custom {
        background-color: #fff;
        border-top: 1px solid rgba(0,0,0,0.125);
        padding: 0.75rem;
    }
    .card-text-muted {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .card-info-row {
        margin-bottom: 0.5rem;
        display: flex;
        flex-wrap: wrap;
    }
    .card-info-label {
        font-weight: bold;
        margin-right: 0.5rem;
        min-width: 120px;
    }
    .action-buttons {
        margin-bottom: 25px;
    }
    .action-buttons .btn {
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s;
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        display: inline-flex;
        align-items: center;
    }
    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .action-buttons .btn i {
        margin-right: 8px;
    }
    .btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        border-color: #28a745;
    }
    .card-action-wrapper {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }
    .card-action-btn {
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    .card-action-btn.btn-rounded {
        border-radius: 20px;
        padding: 10px 20px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        font-size: 0.95rem;
    }
    .card-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: none;
        padding: 8px 0;
    }
    .dropdown-item {
        padding: 8px 16px;
        transition: background-color 0.2s;
    }
    .dropdown-item:hover {
        background-color: rgba(0,123,255,0.1);
    }
    .dropdown-item i {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }
    .dropdown-divider {
        margin: 4px 0;
    }
    .progress-custom {
        height: 8px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #e9ecef;
    }
    .progress-bar-custom {
        border-radius: 10px;
        transition: width 0.3s ease;
    }
    .confetti {
        position: fixed;
        top: -10px;
        z-index: 9999;
        animation: fall linear forwards;
        pointer-events: none;
    }
    @keyframes fall {
        to {
            transform: translateY(100vh) rotate(720deg);
        }
    }
    .alert-success {
        animation: highlight 1s ease-in-out;
    }
    @keyframes highlight {
        0% { transform: scale(1); }
        50% { transform: scale(1.03); }
        100% { transform: scale(1); }
    }
    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    .alert-sm strong {
        font-weight: 600;
    }
    .badge {
        font-size: 0.8em;
        padding: 0.4em 0.6em;
    }
    .badge i {
        margin-right: 0.3em;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4><i class="fas fa-trophy"></i> Achievement Registered!</h4>
                    <p>{{ session('success') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @can('prestasi_mahasiswa_create')
                <div class="action-buttons">
                        <a class="btn btn-success" href="{{ route('frontend.prestasi-mahasiswas.create') }}">
                        <i class="fas fa-plus-circle"></i> Tambah Prestasi
                        </a>
                </div>
            @endcan

            <!-- Draft legend -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i> Draft</span> menandakan form yang belum selesai diisi. Klik "Lanjutkan Pengisian" untuk melanjutkan mengisi form.
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    {{ trans('cruds.prestasiMahasiswa.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="row">
                                @foreach($prestasiMahasiswas as $key => $prestasiMahasiswa)
                            <div class="col-12 mb-4">
                                <div class="card prestasi-card h-100 border-0 shadow-sm">
                                    <div class="card-header-custom">
                                        <h5 class="card-title mb-0">{{ $prestasiMahasiswa->nama_kegiatan ?? 'Draft - Belum Diberi Nama' }}</h5>
                                        <div>
                                            @if($prestasiMahasiswa->is_draft ?? false)
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-exclamation-triangle"></i> Draft
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Selesai
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Basic Information Column -->
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold mb-3">Informasi Prestasi</h6>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}:</span>
                                                    <span>{{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '-' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}:</span>
                                                    <span>{{ $prestasiMahasiswa->kategori->name ?? '-' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}:</span>
                                                    <span>{{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '-' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}:</span>
                                                    <span>{{ $prestasiMahasiswa->nama_penyelenggara ?? '-' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}:</span>
                                                    <span>{{ $prestasiMahasiswa->keikutsertaan ?? '-' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') }}:</span>
                                                    <span>{{ $prestasiMahasiswa->dosen_pembimbing ?? '-' }}</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Status & Progress Column -->
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold mb-3">Status & Progress</h6>
                                                
                                                @if($prestasiMahasiswa->is_draft ?? false)
                                                @php
                                                    $steps = [
                                                            1 => 'Informasi Dasar',
                                                            2 => 'Detail Kegiatan',
                                                            3 => 'Informasi Peserta',
                                                            4 => 'Dokumen Pendukung',
                                                            5 => 'Survey & Perolehan Juara'
                                                    ];
                                                    $currentStep = $prestasiMahasiswa->current_step ?? 1;
                                                        $progress = (($currentStep - 1) / 4) * 100;
                                                @endphp
                                                    
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Progress:</span>
                                                        <span>{{ round($progress) }}% (Langkah {{ $currentStep }} dari 5)</span>
                                                    </div>
                                                    
                                                    <div class="progress progress-custom mt-2 mb-3">
                                                        <div class="progress-bar progress-bar-custom bg-info" role="progressbar" 
                                                         style="width: {{ $progress }}%;" 
                                                         aria-valuenow="{{ $progress }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Langkah Saat Ini:</span>
                                                        <span class="badge badge-info">{{ $steps[$currentStep] }}</span>
                                                    </div>
                                                @else
                                                    <!-- Status for completed submissions -->
                                                    @php
                                                        $validationStatus = $prestasiMahasiswa->validation_status ?? 'pending';
                                                    @endphp
                                                    
                                                    <!-- Validation Status -->
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Status Validasi:</span>
                                                        @if($validationStatus === 'validated')
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-check-circle"></i> Divalidasi
                                                            </span>
                                                        @elseif($validationStatus === 'rejected')
                                                            <span class="badge badge-danger">
                                                                <i class="fas fa-times-circle"></i> Ditolak
                                                            </span>
                                                        @else
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-clock"></i> Menunggu Validasi
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Overall Status Progress Bar -->
                                                    @php
                                                        $overallProgress = 100; // Form is complete
                                                        $progressColor = 'bg-success'; // Default green
                                                        
                                                        if($validationStatus === 'rejected') {
                                                            $progressColor = 'bg-danger';
                                                        } elseif($validationStatus === 'pending') {
                                                            $progressColor = 'bg-warning';
                                                        }
                                                    @endphp
                                                    
                                                    <div class="progress progress-custom mt-2 mb-3">
                                                        <div class="progress-bar progress-bar-custom {{ $progressColor }}" 
                                                             role="progressbar" style="width: {{ $overallProgress }}%;" 
                                                             aria-valuenow="{{ $overallProgress }}" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Validation Notes -->
                                                    @if($validationStatus === 'rejected' && $prestasiMahasiswa->validation_notes)
                                                        <div class="card-info-row">
                                                            <span class="card-info-label">Catatan Penolakan:</span>
                                                            <div class="mt-2">
                                                                <div class="alert alert-danger alert-sm">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    <strong>Alasan Penolakan:</strong><br>
                                                                    {{ $prestasiMahasiswa->validation_notes }}
                                                                </div>
                                                                <small class="text-muted">
                                                                    <i class="fas fa-info-circle"></i> 
                                                                    Silakan perbaiki masalah di atas dan edit kembali pengajuan Anda.
                                                                </small>
                                                            </div>
                                                        </div>
                                                    @elseif($validationStatus === 'validated' && $prestasiMahasiswa->validation_notes)
                                                        <div class="card-info-row">
                                                            <span class="card-info-label">Catatan Validasi:</span>
                                                            <div class="mt-2">
                                                                <div class="alert alert-success alert-sm">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    {{ $prestasiMahasiswa->validation_notes }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <!-- Status Information -->
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Status Form:</span>
                                                        <span class="badge badge-success">Form Lengkap</span>
                                                    </div>
                                                    
                                                    <!-- Status Guidance -->
                                                    @if($validationStatus === 'pending')
                                                        <div class="mt-2">
                                                            <small class="text-info">
                                                                <i class="fas fa-info-circle"></i> 
                                                                Pengajuan Anda sedang dalam proses review oleh admin.
                                                            </small>
                                                        </div>
                                                    @elseif($validationStatus === 'rejected')
                                                        <div class="mt-2">
                                                            <small class="text-warning">
                                                                <i class="fas fa-edit"></i> 
                                                                Pengajuan dapat diedit untuk memperbaiki masalah yang ada.
                                                            </small>
                                                </div>
                                                    @elseif($validationStatus === 'validated')
                                                        <div class="mt-2">
                                                            <small class="text-success">
                                                                <i class="fas fa-trophy"></i> 
                                                                Selamat! Prestasi Anda telah divalidasi dan disetujui.
                                                </small>
                                                        </div>
                                                    @endif
                                                @endif
                                                
                                                @if($prestasiMahasiswa->pesertas && count($prestasiMahasiswa->pesertas) > 0)
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Peserta:</span>
                                                        <div>
                                                            @foreach($prestasiMahasiswa->pesertas as $peserta)
                                                                <span class="badge badge-light mb-1 mr-1">
                                                                    {{ $peserta->nama }} ({{ $peserta->nim }})
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if($prestasiMahasiswa->tanggal_awal && $prestasiMahasiswa->tanggal_akhir)
                                                    <div class="card-info-row">
                                                        <span class="card-info-label">Tanggal:</span>
                                                        <span>{{ $prestasiMahasiswa->tanggal_awal }} - {{ $prestasiMahasiswa->tanggal_akhir }}</span>
                                                    </div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer-custom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle card-action-btn btn-rounded" type="button" id="actionDropdown-{{ $prestasiMahasiswa->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i> Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionDropdown-{{ $prestasiMahasiswa->id }}">
                                                    <!-- Basic Actions -->
                                                    <a class="dropdown-item" href="{{ route('frontend.prestasi-mahasiswas.show', $prestasiMahasiswa->id) }}">
                                                        <i class="fas fa-eye text-primary"></i> {{ trans('global.view') }}
                                                    </a>
                                                    
                                                    <a class="dropdown-item" href="{{ route('frontend.prestasi-mahasiswas.create', ['id' => $prestasiMahasiswa->id]) }}">
                                                        <i class="fas fa-edit text-info"></i> {{ trans('global.edit') }}
                                                    </a>
                                                    
                                                    @if($prestasiMahasiswa->is_draft ?? false)
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('frontend.prestasi-mahasiswas.create', ['draft_id' => $prestasiMahasiswa->id]) }}">
                                                            <i class="fas fa-play text-warning"></i> Lanjutkan Pengisian
                                                        </a>
                                                    @else
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ route('frontend.prestasi-mahasiswas.printBukti') }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Print bukti prestasi?');">
                                                <input type="hidden" name="id" value="{{ $prestasiMahasiswa->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-print text-danger"></i> Print Bukti
                                                            </button>
                                            </form>
                                            @endif
                                                </div>
                                            </div>
                                            <small class="text-muted">ID: {{ $prestasiMahasiswa->id }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                        
                        @if(count($prestasiMahasiswas) == 0)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada prestasi yang terdaftar</h5>
                                        <p class="text-muted">Mulai daftarkan prestasi Anda dengan mengklik tombol "Tambah Prestasi" di atas.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
  // Check if there's a success message and show confetti
  if ($('.alert-success').length > 0) {
    showCongratulationsEffect();
  }

  // Simple confetti effect
  function showCongratulationsEffect() {
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
    const numConfetti = 150;
    
    for (let i = 0; i < numConfetti; i++) {
      const confetti = document.createElement('div');
      confetti.classList.add('confetti');
      confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
      confetti.style.left = Math.random() * 100 + 'vw';
      confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
      confetti.style.opacity = Math.random();
      confetti.style.width = (Math.random() * 10 + 5) + 'px';
      confetti.style.height = (Math.random() * 10 + 5) + 'px';
      document.body.appendChild(confetti);
      
      // Remove confetti after animation
      setTimeout(() => {
        confetti.remove();
      }, 5000);
    }
  }
})
</script>
@endsection
