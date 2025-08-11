@extends('layouts.jobcy')

@section('title', "Certificate Verification - Career Development Center Fakultas Psikologi UNS")

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="fas fa-certificate"></i> Certificate Verification
                    </h3>
                    <p class="mb-0">Career Development Center - Fakultas Psikologi UNS</p>
                </div>
                
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="verified-badge mb-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-success mb-3">✓ Certificate Verified</h4>
                        <p class="text-muted">This certificate is authentic and has been verified by our system.</p>
                    </div>
                    
                    <div class="certificate-details">
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Certificate ID:</div>
                            <div class="col-sm-8">CDC-PSI-{{ $mahasiswaMagang->id }}-{{ $mahasiswaMagang->created_at->format('Ymd') }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Student Name:</div>
                            <div class="col-sm-8">{{ $mahasiswaMagang->nama }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">NIM:</div>
                            <div class="col-sm-8">{{ $mahasiswaMagang->nim }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Program:</div>
                            <div class="col-sm-8">Internship Program</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Institution:</div>
                            <div class="col-sm-8">{{ $mahasiswaMagang->instansi }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Type:</div>
                            <div class="col-sm-8">{{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? $mahasiswaMagang->type }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Status:</div>
                            <div class="col-sm-8">
                                <span class="badge badge-success">Verified & Approved</span>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4 font-weight-bold">Issue Date:</div>
                            <div class="col-sm-8">{{ $mahasiswaMagang->updated_at->format('F j, Y') }}</div>
                        </div>
                        
                        @if($mahasiswaMagang->verified_by)
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Verified By:</div>
                                <div class="col-sm-8">{{ $mahasiswaMagang->verified_by->name }}</div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i>
                        <strong>Note:</strong> This certificate confirms that the student has successfully completed the internship program requirements and all documents have been verified by Career Development Center, Faculty of Psychology, Universitas Sebelas Maret (UNS).
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.verified-badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.certificate-details .row {
    border-bottom: 1px solid #f0f0f0;
    padding: 0.75rem 0;
}

.certificate-details .row:last-child {
    border-bottom: none;
}
</style>
@endsection