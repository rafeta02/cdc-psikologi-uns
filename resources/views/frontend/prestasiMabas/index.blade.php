@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa Baru - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Prestasi Mahasiswa Baru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Prestasi Mahasiswa Baru</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('frontend.prestasi-mabas.create') }}">
                        <i class="fas fa-plus"></i> Tambah Data Prestasi
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trophy"></i>
                        My {{ trans('cruds.prestasiMaba.title_singular') }} {{ trans('global.list') }}
                    </h3>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="row mt-3">
                @forelse($prestasiMabas as $key => $prestasiMaba)
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                            <!-- Simple Modern Header -->
                            <div class="card-header bg-white border-0" style="padding: 1.5rem 1.5rem 0 1.5rem;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2 text-dark fw-bold">{{ $prestasiMaba->nama_kegiatan }}</h5>
                                        <div class="d-flex align-items-center justify-content-center text-muted mb-3">
                                            <i class="fas fa-calendar me-2"></i>
                                            <span class="small">
                                                @if($prestasiMaba->tanggal_awal)
                                                    {{ $prestasiMaba->tanggal_awal }}
                                                    @if($prestasiMaba->tanggal_akhir) - {{ $prestasiMaba->tanggal_akhir }} @endif
                                                @else
                                                    Tanggal tidak tersedia
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                                            {{ App\Models\PrestasiMaba::PEROLEHAN_JUARA_SELECT[$prestasiMaba->perolehan_juara] ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Clean Card Body -->
                            <div class="card-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Tingkat</h6>
                                            <p class="mb-0 fw-medium">{{ App\Models\PrestasiMaba::TINGKAT_RADIO[$prestasiMaba->tingkat] ?? 'N/A' }}</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Kategori</h6>
                                            <p class="mb-0 fw-medium">{{ $prestasiMaba->kategori->name ?? 'N/A' }}</p>
                                        </div>

                                        @if($prestasiMaba->keikutsertaan)
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Keikutsertaan</h6>
                                            <p class="mb-0 fw-medium">{{ App\Models\PrestasiMaba::KEIKUTSERTAAN_RADIO[$prestasiMaba->keikutsertaan] ?? 'N/A' }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Penyelenggara</h6>
                                            <p class="mb-0 fw-medium">{{ $prestasiMaba->nama_penyelenggara }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Tempat</h6>
                                            <p class="mb-0 fw-medium">{{ $prestasiMaba->tempat_penyelenggara }}</p>
                                        </div>

                                        @if($prestasiMaba->bukti_kegiatan && count($prestasiMaba->bukti_kegiatan) > 0)
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-1">Bukti Kegiatan</h6>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                @foreach($prestasiMaba->bukti_kegiatan as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-download me-1"></i>
                                                        {{ $media->name ?? 'File ' . ($key + 1) }}
                                                    </a>
                                                @endforeach
                                            </div>
                                            <small class="text-muted">{{ count($prestasiMaba->bukti_kegiatan) }} file tersedia</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <hr class="my-3">
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="actionDropdown-{{ $prestasiMaba->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionDropdown-{{ $prestasiMaba->id }}">
                                            <a class="dropdown-item" href="{{ route('frontend.prestasi-mabas.show', $prestasiMaba->id) }}">
                                                <i class="fas fa-eye text-primary"></i> Lihat Detail
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{ route('frontend.prestasi-mabas.edit', $prestasiMaba->id) }}">
                                                <i class="fas fa-edit text-info"></i> Edit Data
                                            </a>
                                            
                                            <div class="dropdown-divider"></div>
                                            
                                            <form action="{{ route('frontend.prestasi-mabas.printBukti') }}" method="POST" style="display: inline;">
                                                <input type="hidden" name="id" value="{{ $prestasiMaba->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left;">
                                                    <i class="fas fa-print text-warning"></i> Print Bukti
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm text-center" style="border-radius: 12px;">
                            <div class="card-body py-5">
                                <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada prestasi</h5>
                                <p class="text-muted mb-4">Mulai dokumentasikan prestasi Anda!</p>
                                <a href="{{ route('frontend.prestasi-mabas.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Tambah Prestasi
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
    // Add any custom JavaScript for card interactions if needed
    $('.card').hover(
        function() {
            $(this).addClass('shadow-lg').removeClass('shadow-sm');
        }, 
        function() {
            $(this).addClass('shadow-sm').removeClass('shadow-lg');
        }
    );
});
</script>

<style>
/* Dropdown styling to match mahasiswaMagangs */
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

.dropdown-item.disabled {
    color: #6c757d;
    pointer-events: none;
    background-color: transparent;
}

/* Card hover effects */
.card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-2px);
}

/* Button styling */
.btn.dropdown-toggle {
    border-radius: 6px;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    transition: all 0.3s;
}

.btn.dropdown-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
@endsection
