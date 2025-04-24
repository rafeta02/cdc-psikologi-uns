@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Prestasi Mahasiswa Baru</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.prestasi-mabas.index') }}">Prestasi Mahasiswa Baru</a></li>
                <li class="breadcrumb-item active">Tambah Prestasi</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ trans('global.create') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}</h4>
                </div>

                <div class="card-body">
                    <form id="multiStepForm" method="POST" action="{{ route("frontend.prestasi-mahasiswas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        
                        <!-- Progress bar -->
                        <div class="progressbar-wrapper mb-4">
                            <div class="progressbar">
                                <div class="progress" id="progress"></div>
                                <div class="progress-step active" data-title="Informasi Dasar"></div>
                                <div class="progress-step" data-title="Detail Kegiatan"></div>
                                <div class="progress-step" data-title="Peserta"></div>
                                <div class="progress-step" data-title="Dokumen"></div>
                            </div>
                        </div>

                        <!-- Step 1: Basic Information -->
                        <div class="form-step active">
                            <h3 class="text-center mb-4">Informasi Dasar</h3>
                            
                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="skim_{{ $key }}" name="skim" class="custom-control-input" value="{{ $key }}" {{ old('skim', '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="skim_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="tingkat_{{ $key }}" name="tingkat" class="custom-control-input" value="{{ $key }}" {{ old('tingkat', '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="tingkat_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group text-right mt-4">
                                <button type="button" class="btn btn-primary btn-lg next-btn">Lanjut <i class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </div>

                        <!-- Step 2: Activity Details -->
                        <div class="form-step">
                            <h3 class="text-center mb-4">Detail Kegiatan</h3>

                            <div class="form-group">
                                <label class="required font-weight-bold" for="nama_kegiatan">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</label>
                                <input class="form-control form-control-lg" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', '') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="kategori_id">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</label>
                                <select class="form-control select2" name="kategori_id" id="kategori_id">
                                    @foreach($kategoris as $id => $entry)
                                        <option value="{{ $id }}" {{ old('kategori_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_awal">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}</label>
                                        <input class="form-control date" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                                        <input class="form-control date" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}</label>
                                @foreach(App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" value="{{ $key }}" {{ old('jumlah_peserta', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="jumlah_peserta_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if($errors->has('jumlah_peserta'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jumlah_peserta') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta_helper') }}</span>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                <button type="button" class="btn btn-primary btn-lg next-btn">Lanjut <i class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </div>

                        <!-- Step 3: Participant Information -->
                        <div class="form-step">
                            <h3 class="text-center mb-4">Informasi Peserta</h3>

                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" class="custom-control-input keikutsertaan-radio" value="{{ $key }}" {{ old('keikutsertaan', '') === (string) $key ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="peserta-wrapper">
                                <div class="card mb-3 peserta-group">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Peserta 1</h5>
                                        <button type="button" class="btn btn-success btn-sm add-peserta" style="display: none;">
                                            <i class="fas fa-plus"></i> Tambah Peserta
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="nama_peserta_0">Nama Peserta</label>
                                            <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta_0" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="nim_peserta_0">NIM Peserta</label>
                                            <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta_0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                <button type="button" class="btn btn-primary btn-lg next-btn">Lanjut <i class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </div>

                        <!-- Step 4: Documents -->
                        <div class="form-step">
                            <h3 class="text-center mb-4">Dokumen Pendukung</h3>

                            <!-- Keep existing dropzone fields with improved styling -->
                            <div class="form-group">
                                <label class="font-weight-bold" for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}</label>
                                <div class="needsclick dropzone" id="surat_tugas-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah surat tugas di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Add other document upload fields similarly -->

                            <div class="form-group">
                                <label class="required font-weight-bold" for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}</label>
                                <input class="form-control" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', '') }}" required>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                <button class="btn btn-success btn-lg" type="submit">
                                    <i class="fas fa-save mr-2"></i> {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-step form functionality
    const formSteps = document.querySelectorAll('.form-step');
    const nextBtns = document.querySelectorAll('.next-btn');
    const prevBtns = document.querySelectorAll('.prev-btn');
    const progress = document.getElementById('progress');
    const progressSteps = document.querySelectorAll('.progress-step');
    
    let formStepsNum = 0;
    
    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            formStepsNum++;
            updateFormSteps();
            updateProgressBar();
        });
    });
    
    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            formStepsNum--;
            updateFormSteps();
            updateProgressBar();
        });
    });
    
    function updateFormSteps() {
        formSteps.forEach(step => {
            step.classList.remove('active');
        });
        formSteps[formStepsNum].classList.add('active');
    }
    
    function updateProgressBar() {
        progressSteps.forEach((step, idx) => {
            if (idx <= formStepsNum) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        
        progress.style.width = ((formStepsNum) / (progressSteps.length - 1)) * 100 + '%';
    }

    // Peserta management
    const keikutsertaanRadios = document.querySelectorAll('.keikutsertaan-radio');
    const addPesertaBtn = document.querySelector('.add-peserta');
    let pesertaWrapper = document.getElementById('peserta-wrapper');
    let pesertaIndex = 0;

    keikutsertaanRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'tim_kelompok') {
                addPesertaBtn.style.display = 'block';
            } else {
                addPesertaBtn.style.display = 'none';
                // Remove additional peserta groups
                const pesertaGroups = document.querySelectorAll('.peserta-group');
                Array.from(pesertaGroups).slice(1).forEach(group => group.remove());
            }
        });
    });

    function createPesertaCard(index) {
        return `
            <div class="card mb-3 peserta-group">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Peserta ${index + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-peserta">
                        <i class="fas fa-minus"></i> Hapus
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nama_peserta_${index}">Nama Peserta</label>
                        <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta_${index}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="nim_peserta_${index}">NIM Peserta</label>
                        <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta_${index}" required>
                    </div>
                </div>
            </div>
        `;
    }

    addPesertaBtn.addEventListener('click', function() {
        pesertaIndex++;
        const newPesertaHtml = createPesertaCard(pesertaIndex);
        pesertaWrapper.insertAdjacentHTML('beforeend', newPesertaHtml);
    });

    pesertaWrapper.addEventListener('click', function(e) {
        if (e.target.closest('.remove-peserta')) {
            e.target.closest('.peserta-group').remove();
            updatePesertaTitles();
        }
    });

    function updatePesertaTitles() {
        const pesertaGroups = document.querySelectorAll('.peserta-group');
        pesertaGroups.forEach((group, index) => {
            group.querySelector('.card-title').textContent = `Peserta ${index + 1}`;
        });
    }
});

// Keep existing Dropzone configurations
</script>

<style>
/* Multi-step form styles */
.form-step {
    display: none;
    animation: fadeIn 0.5s;
}

.form-step.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Progress bar styles */
.progressbar-wrapper {
    padding: 10px 0;
    margin-bottom: 30px;
}

.progressbar {
    position: relative;
    display: flex;
    justify-content: space-between;
    counter-reset: step;
    margin: 2rem 0;
}

.progressbar::before,
.progress {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 4px;
    width: 100%;
    background-color: #dcdcdc;
    z-index: 1;
}

.progress {
    background-color: #007bff;
    width: 0%;
    transition: 0.3s;
    z-index: 2;
}

.progress-step {
    width: 35px;
    height: 35px;
    background-color: #dcdcdc;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 3;
    position: relative;
}

.progress-step::before {
    counter-increment: step;
    content: counter(step);
    font-weight: bold;
}

.progress-step::after {
    content: attr(data-title);
    position: absolute;
    top: 45px;
    font-size: 0.85rem;
    width: max-content;
    left: 50%;
    transform: translateX(-50%);
}

.progress-step.active {
    background-color: #007bff;
    color: #fff;
}

/* Form enhancements */
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.card {
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

/* Dropzone customization */
.dropzone {
    border: 2px dashed #007bff;
    border-radius: 5px;
    background: #f8fafc;
    text-align: center;
    padding: 30px;
}

.dz-message {
    margin: 1em 0;
}
</style>
@endsection