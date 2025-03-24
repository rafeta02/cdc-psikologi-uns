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
                <li class="breadcrumb-item"><a href="{{ route('frontend.prestasi-mahasiswas.index') }}">Prestasi Mahasiswa</a></li>
                <li class="breadcrumb-item active">Tambah Prestasi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    .swal2-popup {
        font-size: 1rem !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
                </div>

                <div class="card-body">
                    <!-- Step progress indicator -->
                    <div class="mb-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <ul class="nav nav-pills nav-justified mt-3">
                            <li class="nav-item">
                                <a class="nav-link active" id="step1-tab" data-toggle="pill" href="#step1">Informasi Umum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="step2-tab" data-toggle="pill" href="#step2">Informasi Peserta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="step3-tab" data-toggle="pill" href="#step3">Dokumen Pendukung</a>
                            </li>
                        </ul>
                    </div>

                    <form id="multiStepForm" method="POST" action="{{ route('frontend.prestasi-mahasiswas.store') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="current_step" id="current_step" value="1">
                        <input type="hidden" name="draft_id" id="draft_id" value="{{ request('draft_id', '') }}">

                        <div class="tab-content">
                            <!-- Step 1: Informasi Umum -->
                            <div class="tab-pane fade show active" id="step1">
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="skim_{{ $key }}" name="skim" value="{{ $key }}" {{ old('skim', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="skim_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('skim'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('skim') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.skim_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" {{ old('tingkat', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="tingkat_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('tingkat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tingkat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tingkat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_kegiatan">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</label>
                            <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', '') }}" required>
                            @if($errors->has('nama_kegiatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_kegiatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</label>
                            <select class="form-control select2" name="kategori_id" id="kategori_id">
                                @foreach($kategoris as $id => $entry)
                                    <option value="{{ $id }}" {{ old('kategori_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kategori'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kategori') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.kategori_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}</label>
                            <input class="form-control date" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal') }}">
                            @if($errors->has('tanggal_awal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_awal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                            <input class="form-control date" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                            @if($errors->has('tanggal_akhir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_akhir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir_helper') }}</span>
                        </div>
                                
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-primary next-step" data-step="1">
                                        Selanjutnya <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Informasi Peserta -->
                            <div class="tab-pane fade" id="step2">
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
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}</label>
                            <select class="form-control" name="perolehan_juara" id="perolehan_juara" required>
                                <option value disabled {{ old('perolehan_juara', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('perolehan_juara', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('perolehan_juara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('perolehan_juara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nama_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}</label>
                            <input class="form-control" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', '') }}" required>
                            @if($errors->has('nama_penyelenggara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_penyelenggara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tempat_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}</label>
                            <input class="form-control" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', '') }}" required>
                            @if($errors->has('tempat_penyelenggara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat_penyelenggara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</label>
                            @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" value="{{ $key }}" {{ old('keikutsertaan', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('keikutsertaan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('keikutsertaan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan_helper') }}</span>
                        </div>

                        <!-- Dynamic Nama Peserta and NIM Peserta -->
                        <div id="peserta-wrapper">
                            <div class="card mb-3 peserta-group">
                                <div class="card-header">
                                    <h5 class="card-title">Peserta 1</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_peserta">
                                            Nama Peserta
                                        </label>
                                        <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta" value="{{ old('nama_peserta.0', '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="nim_peserta">
                                            NIM Peserta
                                        </label>
                                        <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta" value="{{ old('nim_peserta.0', '') }}">
                                    </div>

                                    <button type="button" class="btn btn-success add-peserta">
                                        <i class="fas fa-plus"></i> Tambah Peserta
                                    </button>
                                </div>
                            </div>
                        </div>

                                <div class="form-group">
                                    <label for="dosen_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') ?? 'Dosen Pembimbing' }}</label>
                                    <input class="form-control" type="text" name="dosen_pembimbing" id="dosen_pembimbing" value="{{ old('dosen_pembimbing', '') }}">
                                    @if($errors->has('dosen_pembimbing'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('dosen_pembimbing') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing_helper') ?? 'Masukkan nama dosen pembimbing (jika ada)' }}</span>
                                </div>

                        <div class="form-group">
                            <label for="url_publikasi">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}</label>
                            <input class="form-control" type="text" name="url_publikasi" id="url_publikasi" value="{{ old('url_publikasi', '') }}">
                            @if($errors->has('url_publikasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('url_publikasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi_helper') }}</span>
                        </div>

                                <div class="form-group d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step" data-step="2">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary next-step" data-step="2">
                                        Selanjutnya <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Dokumen Pendukung -->
                            <div class="tab-pane fade" id="step3">
                                <h4 class="card-title">Langkah 3: Dokumen Pendukung</h4>
                                
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong> 
                                    <ul class="mb-0 mt-2">
                                        <li>Semua dokumen pada langkah ini <strong>WAJIB</strong> diunggah untuk menyelesaikan dan mengirimkan formulir prestasi.</li>
                                        <li>Anda dapat menyimpan formulir sebagai draft dan melengkapi dokumen nanti dengan mengklik tombol <strong>"Simpan Draft"</strong>.</li>
                                        <li>Untuk menyelesaikan formulir, semua dokumen harus diunggah dan klik tombol <strong>"Kirim & Selesaikan"</strong>.</li>
                                    </ul>
                                </div>
                                
                        <div class="form-group">
                                    <label for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', '') }}" required>
                                    @if($errors->has('no_wa'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('no_wa') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.no_wa_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }} <span class="text-danger">*</span></label>
                            <div class="needsclick dropzone" id="surat_tugas-dropzone">
                            </div>
                            @if($errors->has('surat_tugas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_helper') }}</span>
                        </div>
                        <div class="form-group">
                                    <label for="sertifikat">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }} <span class="text-danger">*</span></label>
                            <div class="needsclick dropzone" id="sertifikat-dropzone">
                            </div>
                            @if($errors->has('sertifikat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sertifikat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat_helper') }}</span>
                        </div>
                        <div class="form-group">
                                    <label for="foto_dokumentasi">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }} <span class="text-danger">*</span></label>
                            <div class="needsclick dropzone" id="foto_dokumentasi-dropzone">
                            </div>
                            @if($errors->has('foto_dokumentasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('foto_dokumentasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                                    <label for="surat_tugas_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }} <span class="text-danger">*</span></label>
                            <div class="needsclick dropzone" id="surat_tugas_pembimbing-dropzone">
                            </div>
                            @if($errors->has('surat_tugas_pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas_pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                                    <label for="bukti_sipsmart">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }} <span class="text-danger">*</span></label>
                            <div class="needsclick dropzone" id="bukti_sipsmart-dropzone">
                            </div>
                            @if($errors->has('bukti_sipsmart'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bukti_sipsmart') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart_helper') }}</span>
                        </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step" data-step="3">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <div>
                                        <button type="button" id="save-draft-btn" class="btn btn-info mr-2">
                                            <i class="fas fa-save"></i> Simpan Draft (Lengkapi Dokumen Nanti)
                                        </button>
                            <button class="btn btn-danger" type="submit">
                                            <i class="fas fa-check-circle"></i> Kirim & Selesaikan
                            </button>
                                    </div>
                                </div>
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
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let pesertaWrapper = document.getElementById('peserta-wrapper');
        let pesertaIndex = 1;
        let currentStep = 1;
        const totalSteps = 3;
        const progressBar = document.querySelector('.progress-bar');
        const form = document.getElementById('multiStepForm');
        let draftId = document.getElementById('draft_id').value;

        // Handle step navigation
        function goToStep(step) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            // Deactivate all tabs
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show current tab pane and activate its tab
            document.getElementById(`step${step}`).classList.add('show', 'active');
            document.getElementById(`step${step}-tab`).classList.add('active');
            
            // Update progress bar
            const progress = ((step - 1) / (totalSteps - 1)) * 100;
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = `${Math.round(progress)}%`;
            
            // Update current step
            currentStep = step;
            document.getElementById('current_step').value = step;
        }

        // Save current step data via AJAX
        function saveStep(step, goToNextStep = true) {
            // For step 3, do client-side validation first if going to next step
            if (step === 3 && goToNextStep) {
                // Check if all required files are uploaded
                const suratTugasFiles = document.querySelectorAll('input[name="surat_tugas[]"]').length;
                const sertifikatFiles = document.querySelectorAll('input[name="sertifikat[]"]').length;
                const fotoDokumentasiFiles = document.querySelectorAll('input[name="foto_dokumentasi[]"]').length;
                const suratTugasPembimbingFile = document.querySelector('input[name="surat_tugas_pembimbing"]');
                const buktiSipsmartFiles = document.querySelectorAll('input[name="bukti_sipsmart[]"]').length;
                
                // Create a list of missing files
                const missingFiles = [];
                if (suratTugasFiles === 0) missingFiles.push('Surat Tugas');
                if (sertifikatFiles === 0) missingFiles.push('Sertifikat');
                if (fotoDokumentasiFiles === 0) missingFiles.push('Foto Dokumentasi');
                if (!suratTugasPembimbingFile) missingFiles.push('Surat Tugas Pembimbing');
                if (buktiSipsmartFiles === 0) missingFiles.push('Bukti SIPSMART');
                
                if (missingFiles.length > 0) {
                    // If there are missing files, show warning and ask if they want to save as draft
                    let missingFilesList = '';
                    missingFiles.forEach(file => {
                        missingFilesList += `<li class="text-danger">${file}</li>`;
                    });
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'Dokumen Belum Lengkap',
                        html: `
                            <p>Dokumen berikut belum diunggah:</p>
                            <ul style="text-align: left; margin-top: 10px;">
                                ${missingFilesList}
                            </ul>
                            <p class="mt-3">Data akan disimpan sebagai draft. Anda dapat melanjutkan pengisian nanti.</p>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan sebagai Draft',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Save without the goToNextStep flag
                            saveStep(step, false);
                        }
                    });
                    
                    return; // Stop execution here
                }
            }
            
            // Show loading indicator
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            const formData = new FormData(form);
            formData.append('_method', 'POST');
            formData.append('save_step', step);
            
            // Add draft_id if we have one
            if (draftId) {
                formData.append('draft_id', draftId);
            }

            // Use fetch API to submit form data
            fetch('{{ route("frontend.prestasi-mahasiswas.save-step") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If this is the first step save, update draft_id
                    if (data.draft_id && !draftId) {
                        draftId = data.draft_id;
                        document.getElementById('draft_id').value = draftId;
                        
                        // Update URL with draft_id without page refresh
                        const url = new URL(window.location);
                        url.searchParams.set('draft_id', draftId);
                        window.history.pushState({}, '', url);
                    }
                    
                    // Show success message with SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Langkah ${step} berhasil disimpan`,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Go to next step if requested
                        if (goToNextStep && step < totalSteps) {
                            goToStep(step + 1);
                        }
                    });
                } else {
                    // Show error message with SweetAlert2
                    let errorMessage = data.message || 'Terjadi kesalahan saat menyimpan data.';
                    let errorDetails = '';
                    
                    // Check if we have missing files
                    if (data.missing_files && data.missing_files.length > 0) {
                        errorDetails = '<p>Dokumen yang belum diunggah:</p><ul>';
                        data.missing_files.forEach(file => {
                            errorDetails += `<li>${file}</li>`;
                        });
                        errorDetails += '</ul>';
                    } else if (data.errors) {
                        // If we have other error details
                        errorDetails = Object.values(data.errors).flat().join('<br>');
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        html: errorMessage + '<br>' + errorDetails,
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        // Event listeners for next/prev buttons
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                const step = parseInt(this.getAttribute('data-step'));
                saveStep(step);
            });
        });

        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                const step = parseInt(this.getAttribute('data-step'));
                goToStep(step - 1);
            });
        });

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if we are on step 3 and validate file uploads
            if (currentStep === 3) {
                // Check if all required files are uploaded by looking for hidden input fields
                const suratTugasFiles = document.querySelectorAll('input[name="surat_tugas[]"]').length;
                const sertifikatFiles = document.querySelectorAll('input[name="sertifikat[]"]').length;
                const fotoDokumentasiFiles = document.querySelectorAll('input[name="foto_dokumentasi[]"]').length;
                const suratTugasPembimbingFile = document.querySelector('input[name="surat_tugas_pembimbing"]');
                const buktiSipsmartFiles = document.querySelectorAll('input[name="bukti_sipsmart[]"]').length;
                
                // Validate all files are present
                if (suratTugasFiles === 0 || sertifikatFiles === 0 || fotoDokumentasiFiles === 0 || 
                    !suratTugasPembimbingFile || buktiSipsmartFiles === 0) {
                    
                    // Create a list of missing files
                    const missingFiles = [];
                    if (suratTugasFiles === 0) missingFiles.push('Surat Tugas');
                    if (sertifikatFiles === 0) missingFiles.push('Sertifikat');
                    if (fotoDokumentasiFiles === 0) missingFiles.push('Foto Dokumentasi');
                    if (!suratTugasPembimbingFile) missingFiles.push('Surat Tugas Pembimbing');
                    if (buktiSipsmartFiles === 0) missingFiles.push('Bukti SIPSMART');
                    
                    // Show error with missing files list
                    let missingFilesList = '';
                    missingFiles.forEach(file => {
                        missingFilesList += `<li class="text-danger">${file}</li>`;
                    });
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Dokumen Belum Lengkap',
                        html: `
                            <p>Semua dokumen berikut wajib diunggah untuk menyelesaikan pengisian form:</p>
                            <ul style="text-align: left; margin-top: 10px;">
                                ${missingFilesList}
                            </ul>
                            <p class="mt-3 mb-0">Untuk menyimpan progres tanpa mengunggah semua dokumen,<br>silakan gunakan tombol <strong>"Simpan Draft"</strong>.</p>
                        `,
                        confirmButtonText: 'Lengkapi Dokumen'
                    });
                    
                    return;
                }
            }
            
            // Show loading indicator
            Swal.fire({
                title: 'Mengirimkan Data...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Save current step first
            saveStep(currentStep, false);
            
            // Submit the form
            setTimeout(() => {
                if (draftId) {
                    form.action = `{{ route("frontend.prestasi-mahasiswas.store") }}?draft_id=${draftId}`;
                }
                form.submit();
            }, 500);
        });

        // If we have a draft_id, attempt to load the saved data
        if (draftId) {
            // Show loading indicator
            Swal.fire({
                title: 'Memuat Draft...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`{{ route("frontend.prestasi-mahasiswas.get-draft") }}?draft_id=${draftId}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Close loading indicator
                Swal.close();
                
                if (data.success && data.draft) {
                    // Populate form fields with draft data
                    populateFormFields(data.draft);
                    
                    // Go to the saved step or step 1
                    const savedStep = data.draft.current_step || 1;
                    goToStep(parseInt(savedStep));
                    
                    // Show a toast notification that draft was loaded
                    Swal.fire({
                        icon: 'info',
                        title: 'Draft Dimuat',
                        text: 'Data draft berhasil dimuat. Anda dapat melanjutkan pengisian form.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                console.error('Error loading draft data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data draft.',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        function populateFormFields(data) {
            // Populate form fields with data from the draft
            for (const key in data) {
                const formElement = form.elements[key];
                if (formElement) {
                    if (formElement.type === 'radio') {
                        const radio = document.querySelector(`input[name="${key}"][value="${data[key]}"]`);
                        if (radio) radio.checked = true;
                    } else if (formElement.type === 'select-one') {
                        formElement.value = data[key];
                    } else if (formElement.type !== 'file') {
                        formElement.value = data[key];
                    }
                }
            }
            
            // Special handling for peserta fields (array data)
            if (data.nama_peserta && data.nama_peserta.length > 0) {
                const pesertaGroups = document.querySelectorAll('.peserta-group');
                
                // Remove all but the first peserta group
                for (let i = pesertaGroups.length - 1; i > 0; i--) {
                    pesertaGroups[i].remove();
                }
                
                // Add peserta groups for each saved peserta
                for (let i = 0; i < data.nama_peserta.length; i++) {
                    if (i === 0) {
                        // Update the first peserta group
                        document.querySelector('input[name="nama_peserta[]"]').value = data.nama_peserta[i] || '';
                        document.querySelector('input[name="nim_peserta[]"]').value = data.nim_peserta[i] || '';
                    } else {
                        // Add new peserta groups for additional peserta
                        document.querySelector('.add-peserta').click();
                        const newGroups = document.querySelectorAll('.peserta-group');
                        const lastGroup = newGroups[newGroups.length - 1];
                        lastGroup.querySelector('input[name="nama_peserta[]"]').value = data.nama_peserta[i] || '';
                        lastGroup.querySelector('input[name="nim_peserta[]"]').value = data.nim_peserta[i] || '';
                    }
                }
            }
        }

        // Peserta handling
        function updatePesertaTitles() {
            let pesertaGroups = document.querySelectorAll('.peserta-group');
            pesertaGroups.forEach((group, index) => {
                group.querySelector('.card-title').textContent = `Peserta ${index + 1}`;
                group.querySelector('input[name="nama_peserta[]"]').id = `nama_peserta_${index}`;
                group.querySelector('input[name="nim_peserta[]"]').id = `nim_peserta_${index}`;
            });
        }

        document.querySelector('.add-peserta').addEventListener('click', function() {
            let newPesertaGroup = document.querySelector('.peserta-group').cloneNode(true);
            newPesertaGroup.querySelectorAll('input').forEach(input => input.value = '');
            newPesertaGroup.querySelector('.add-peserta').innerHTML = '<i class="fas fa-minus"></i> Remove Peserta';
            newPesertaGroup.querySelector('.add-peserta').classList.remove('btn-success');
            newPesertaGroup.querySelector('.add-peserta').classList.add('btn-danger');
            newPesertaGroup.querySelector('.add-peserta').classList.add('remove-peserta');
            pesertaWrapper.appendChild(newPesertaGroup);
            pesertaIndex++;
            updatePesertaTitles();
        });

        pesertaWrapper.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-peserta')) {
                e.target.closest('.peserta-group').remove();
                pesertaIndex--;
                updatePesertaTitles();
            }
        });

        updatePesertaTitles();

        // Save Draft button (without file validation)
        document.getElementById('save-draft-btn').addEventListener('click', function() {
            // Show confirmation dialog
            Swal.fire({
                title: 'Simpan Sebagai Draft?',
                text: 'Anda dapat melanjutkan pengisian form ini nanti',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Draft',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading indicator
                    Swal.fire({
                        title: 'Menyimpan Draft...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Save the current step first
                    const formData = new FormData(form);
                    formData.append('_method', 'POST');
                    formData.append('save_step', currentStep);
                    // Add draft_id if we have one
                    if (draftId) {
                        formData.append('draft_id', draftId);
                    }
                    // Flag this as an explicit draft save request
                    formData.append('save_as_draft', '1');

                    // Use fetch API to submit form data
                    fetch('{{ route("frontend.prestasi-mahasiswas.save-step") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message and redirect to index
                            Swal.fire({
                                icon: 'success',
                                title: 'Draft Tersimpan!',
                                text: 'Anda dapat melanjutkan pengisian form ini nanti',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = '{{ route("frontend.prestasi-mahasiswas.index") }}';
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menyimpan Draft',
                                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Gagal menyimpan draft',
                            confirmButtonText: 'Tutup'
                        });
                    });
                }
            });
        });
    });
</script>

<script>
var uploadedSuratTugasMap = {}
Dropzone.options.suratTugasDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      draft_id: function() {
        return document.getElementById('draft_id').value;
      }
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="surat_tugas[]" value="' + response.name + '">')
      uploadedSuratTugasMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSuratTugasMap[file.name]
      }
      $('form').find('input[name="surat_tugas[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->surat_tugas)
          var files =
            {!! json_encode($prestasiMahasiswa->surat_tugas) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="surat_tugas[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedSertifikatMap = {}
Dropzone.options.sertifikatDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      draft_id: function() {
        return document.getElementById('draft_id').value;
      }
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="sertifikat[]" value="' + response.name + '">')
      uploadedSertifikatMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSertifikatMap[file.name]
      }
      $('form').find('input[name="sertifikat[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->sertifikat)
          var files =
            {!! json_encode($prestasiMahasiswa->sertifikat) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="sertifikat[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedFotoDokumentasiMap = {}
Dropzone.options.fotoDokumentasiDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096,
      draft_id: function() {
        return document.getElementById('draft_id').value;
      }
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + response.name + '">')
      uploadedFotoDokumentasiMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFotoDokumentasiMap[file.name]
      }
      $('form').find('input[name="foto_dokumentasi[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->foto_dokumentasi)
      var files = {!! json_encode($prestasiMahasiswa->foto_dokumentasi) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
<script>
    Dropzone.options.suratTugasPembimbingDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      draft_id: function() {
        return document.getElementById('draft_id').value;
      }
    },
    success: function (file, response) {
      $('form').find('input[name="surat_tugas_pembimbing"]').remove()
      $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="surat_tugas_pembimbing"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->surat_tugas_pembimbing)
      var file = {!! json_encode($prestasiMahasiswa->surat_tugas_pembimbing) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedBuktiSipsmartMap = {}
Dropzone.options.buktiSipsmartDropzone = {
    url: '{{ route('frontend.prestasi-mahasiswas.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096,
      draft_id: function() {
        return document.getElementById('draft_id').value;
      }
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + response.name + '">')
      uploadedBuktiSipsmartMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBuktiSipsmartMap[file.name]
      }
      $('form').find('input[name="bukti_sipsmart[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prestasiMahasiswa) && $prestasiMahasiswa->bukti_sipsmart)
      var files = {!! json_encode($prestasiMahasiswa->bukti_sipsmart) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection
