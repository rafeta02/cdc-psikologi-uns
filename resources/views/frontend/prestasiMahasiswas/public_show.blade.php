@extends('layouts.jobcy')

@section('title', 'Student Achievement - CDC Faculty of Psychology UNS')

@section('meta')
<meta name="description" content="Student achievement details from Faculty of Psychology UNS">
<meta property="og:title" content="{{ $prestasiMahasiswa->nama_kegiatan }} - Student Achievement">
<meta property="og:description" content="Achievement by {{ $prestasiMahasiswa->pesertas->first()->nama ?? 'Student' }} in {{ $prestasiMahasiswa->nama_kegiatan }}">
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title text-white mb-0">
                                    <i class="uil uil-trophy me-2"></i>Student Achievement Details
                                </h4>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-light text-primary px-3 py-2">
                                    {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? 'Achievement' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Achievement Title -->
                        <div class="text-center mb-5">
                            <h2 class="text-primary fw-bold mb-3">{{ $prestasiMahasiswa->nama_kegiatan }}</h2>
                            <p class="text-muted fs-5">{{ $prestasiMahasiswa->nama_penyelenggara }}</p>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                                        <div class="text-center">
                                            <i class="uil uil-calendar-alt text-primary fs-4"></i>
                                            <p class="mb-0 small text-muted">Date</p>
                                            <p class="mb-0 fw-medium">{{ date('d M Y', strtotime($prestasiMahasiswa->tanggal_awal)) }}</p>
                                        </div>
                                        <div class="text-center">
                                            <i class="uil uil-map-marker text-primary fs-4"></i>
                                            <p class="mb-0 small text-muted">Location</p>
                                            <p class="mb-0 fw-medium">{{ $prestasiMahasiswa->tempat_penyelenggara }}</p>
                                        </div>
                                        <div class="text-center">
                                            <i class="uil uil-users-alt text-primary fs-4"></i>
                                            <p class="mb-0 small text-muted">Category</p>
                                            <p class="mb-0 fw-medium">{{ App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$prestasiMahasiswa->jumlah_peserta] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Achievement Details -->
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4">
                                            <i class="uil uil-info-circle me-2"></i>Achievement Information
                                        </h5>
                                        
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-sm bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="uil uil-layer-group text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Competition Type</h6>
                                                        <p class="text-muted mb-0">{{ App\Models\PrestasiMahasiswa::SKIM_RADIO[$prestasiMahasiswa->skim] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-sm bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="uil uil-globe text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Level</h6>
                                                        <p class="text-muted mb-0">{{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-sm bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="uil uil-tag text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Category</h6>
                                                        <p class="text-muted mb-0">{{ $prestasiMahasiswa->kategori->name ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-sm bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="uil uil-user-check text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Participation</h6>
                                                        <p class="text-muted mb-0">{{ App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasiMahasiswa->keikutsertaan] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($prestasiMahasiswa->dosen_pembimbing)
                                        <div class="mt-4 pt-3 border-top">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-sm bg-success bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="uil uil-user-md text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Supervisor</h6>
                                                    <p class="text-muted mb-0">{{ $prestasiMahasiswa->dosen_pembimbing }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4">
                                            <i class="uil uil-users-alt me-2"></i>Participants
                                        </h5>
                                        
                                        @foreach ($prestasiMahasiswa->pesertas as $peserta)
                                        <div class="d-flex align-items-center {{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm bg-primary bg-soft rounded-circle d-flex align-items-center justify-content-center">
                                                    <span class="text-primary fw-bold">{{ $loop->iteration }}</span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $peserta->nama }}</h6>
                                                <p class="text-muted mb-0 small">{{ $peserta->nim }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                @if($prestasiMahasiswa->url_publikasi)
                                <div class="card border-0 bg-light mt-3">
                                    <div class="card-body text-center">
                                        <h6 class="text-primary mb-3">
                                            <i class="uil uil-link me-2"></i>Publication Link
                                        </h6>
                                        <a href="{{ $prestasiMahasiswa->url_publikasi }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="uil uil-external-link-alt me-1"></i>View Publication
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Documentation Gallery -->
                        @if($prestasiMahasiswa->foto_dokumentasi && count($prestasiMahasiswa->foto_dokumentasi) > 0)
                        <div class="mt-5">
                            <h5 class="text-primary mb-4">
                                <i class="uil uil-images me-2"></i>Documentation Gallery
                            </h5>
                            <div class="row g-3">
                                @foreach($prestasiMahasiswa->foto_dokumentasi as $media)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card border-0 shadow-sm">
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            <img src="{{ $media->getUrl('thumb') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Documentation">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Footer -->
                        <div class="mt-5 pt-4 border-top text-center">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <img src="{{ asset('jobcy/images/logo/logo-dark.png') }}" alt="CDC Psychology UNS" height="20" class="mb-2">
                                    <p class="text-muted mb-0 small">Career Development Center<br>Faculty of Psychology, Universitas Sebelas Maret</p>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <p class="text-muted mb-0 small">
                                        <i class="uil uil-calendar-alt me-1"></i>
                                        Verified on {{ date('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.bg-soft {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}
.avatar-sm {
    height: 2.5rem;
    width: 2.5rem;
}
</style>
@endsection 