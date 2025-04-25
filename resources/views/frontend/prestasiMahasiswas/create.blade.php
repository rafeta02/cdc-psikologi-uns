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
                            <li class="nav-item">
                                <a class="nav-link" id="step4-tab" data-toggle="pill" href="#step4">Survey</a>
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
                                    <input type="radio" id="skim_{{ $key }}" name="skim" value="{{ $key }}" 
                                        {{ old('skim', $draft->skim ?? 'non_lomba') === (string) $key ? 'checked' : '' }} required>
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
                                    <input type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" 
                                        {{ old('tingkat', $draft->tingkat ?? 'nasional') === (string) $key ? 'checked' : '' }} required>
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
                            <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $draft->nama_kegiatan ?? '') }}" required>
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
                                    <option value="{{ $id }}" {{ old('kategori_id', $draft->kategori_id ?? '1') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control date" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal', $draft->tanggal_awal ?? '') }}" required>
                            @if($errors->has('tanggal_awal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_awal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                            <input class="form-control date" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', $draft->tanggal_akhir ?? '') }}" required>
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
                                    <input type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" value="{{ $key }}" {{ old('jumlah_peserta', $draft->jumlah_peserta ?? '') === (string) $key ? 'checked' : '' }} required>
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
                                <option value disabled {{ old('perolehan_juara', $draft->perolehan_juara ?? null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('perolehan_juara', $draft->perolehan_juara ?? '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                            <input class="form-control" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', $draft->nama_penyelenggara ?? '') }}" required>
                            @if($errors->has('nama_penyelenggara'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_penyelenggara') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tempat_penyelenggara">{{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}</label>
                            <input class="form-control" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', $draft->tempat_penyelenggara ?? '') }}" required>
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
                                    <input type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" value="{{ $key }}" {{ old('keikutsertaan', $draft->keikutsertaan ?? '') === (string) $key ? 'checked' : '' }}>
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
                                        <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta" value="{{ old('nama_peserta.0', $draft->nama_peserta[0] ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="nim_peserta">
                                            NIM Peserta
                                        </label>
                                        <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta" value="{{ old('nim_peserta.0', $draft->nim_peserta[0] ?? '') }}">
                                    </div>

                                    <button type="button" class="btn btn-success add-peserta">
                                        <i class="fas fa-plus"></i> Tambah Peserta
                                    </button>
                                </div>
                            </div>
                        </div>

                                <div class="form-group">
                                    <label for="dosen_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') ?? 'Dosen Pembimbing' }}</label>
                                    <input class="form-control" type="text" name="dosen_pembimbing" id="dosen_pembimbing" value="{{ old('dosen_pembimbing', $draft->dosen_pembimbing ?? '') }}">
                                    @if($errors->has('dosen_pembimbing'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('dosen_pembimbing') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing_helper') ?? 'Masukkan nama dosen pembimbing (jika ada)' }}</span>
                                </div>

                        <div class="form-group">
                            <label for="url_publikasi">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}</label>
                            <input class="form-control" type="text" name="url_publikasi" id="url_publikasi" value="{{ old('url_publikasi', $draft->url_publikasi ?? '') }}">
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
                                        <li>Untuk menyelesaikan formulir, semua dokumen harus diunggah dan klik tombol <strong>"Lanjut ke Survey"</strong>.</li>
                                    </ul>
                                </div>
                                
                                <div class="form-group">
                                            <label for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $draft->no_wa ?? '') }}" required>
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
                                            <i class="fas fa-save"></i> Simpan Draft
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-step="3">
                                            Lanjut ke Survey <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Survey -->
                            <div class="tab-pane fade" id="step4">
                                <h4 class="card-title">Langkah 4: Survey</h4>
                                
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong> 
                                    <p class="mb-0">Mohon isi survey berikut untuk membantu kami meningkatkan layanan CDC Fakultas Psikologi UNS.</p>
                                </div>

                                <div class="form-group">
                                    <label for="informasi_lomba">Dari mana Anda mendapatkan informasi mengenai lomba/kegiatan ini?</label>
                                    <textarea class="form-control" name="informasi_lomba" id="informasi_lomba" rows="3" required>{{ old('informasi_lomba', $draft->informasi_lomba ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="tips_trik">Tips & trik dalam mengikuti lomba/kegiatan ini:</label>
                                    <textarea class="form-control" name="tips_trik" id="tips_trik" rows="3" required>{{ old('tips_trik', $draft->tips_trik ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Apakah Anda bersedia menjadi mentor untuk adik tingkat yang akan mengikuti lomba/kegiatan serupa?</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="bersedia_mentoring_1" name="bersedia_mentoring" value="1" class="custom-control-input" {{ old('bersedia_mentoring', $draft->bersedia_mentoring ?? '') == '1' ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="bersedia_mentoring_1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="bersedia_mentoring_0" name="bersedia_mentoring" value="0" class="custom-control-input" {{ old('bersedia_mentoring', $draft->bersedia_mentoring ?? '') == '0' ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="bersedia_mentoring_0">Tidak</label>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step" data-step="4">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <div>
                                        <button type="button" id="save-draft-btn-survey" class="btn btn-info mr-2">
                                            <i class="fas fa-save"></i> Simpan Draft
                                        </button>
                                        <button type="submit" class="btn btn-danger" id="submit-form">
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
        let currentStep = 1;
        const totalSteps = 4;
        const form = document.getElementById('multiStepForm');
        const progressBar = document.querySelector('.progress-bar');
        let draftId = document.getElementById('draft_id').value;

        // Function to save current step
        function saveStep(step, saveAsDraft = false) {
            Swal.fire({
                title: saveAsDraft ? 'Menyimpan Draft...' : 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(form);
            formData.append('current_step', step);
            formData.append('save_as_draft', saveAsDraft ? '1' : '0');
            
            // Ensure required fields have at least empty string values
            const requiredFields = [
                'nama_penyelenggara',
                'tempat_penyelenggara',
                'dosen_pembimbing',
                'url_publikasi',
                'no_wa',
                'informasi_lomba',
                'tips_trik'
            ];

            requiredFields.forEach(field => {
                if (!formData.has(field)) {
                    formData.append(field, '');
                }
            });

            // Set default values for radio buttons if not set
            if (!formData.has('jumlah_peserta')) {
                formData.append('jumlah_peserta', 'individu');
            }
            if (!formData.has('perolehan_juara')) {
                formData.append('perolehan_juara', 'juara_1');
            }
            if (!formData.has('keikutsertaan')) {
                formData.append('keikutsertaan', 'offline');
            }
            if (!formData.has('bersedia_mentoring')) {
                formData.append('bersedia_mentoring', '0');
            }
            
            if (draftId) {
                formData.append('draft_id', draftId);
            }

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
                    if (data.draft_id && !draftId) {
                        draftId = data.draft_id;
                        document.getElementById('draft_id').value = draftId;
                        // Update URL with draft_id
                        const url = new URL(window.location);
                        url.searchParams.set('draft_id', draftId);
                        window.history.pushState({}, '', url);
                    }

                    if (saveAsDraft) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Draft Tersimpan!',
                            text: 'Data berhasil disimpan sebagai draft',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '{{ route("frontend.prestasi-mahasiswas.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Langkah ' + step + ' berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            if (step < totalSteps) {
                                goToStep(step + 1);
                            }
                        });
                    }
                } else {
                    throw new Error(data.message || 'Failed to save data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: error.message || 'Gagal menyimpan data',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        // Function to go to a specific step
        function goToStep(step) {
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.classList.remove('active');
            });
            
            document.getElementById(`step${step}`).classList.add('show', 'active');
            document.getElementById(`step${step}-tab`).classList.add('active');
            
            const progress = ((step - 1) / (totalSteps - 1)) * 100;
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = `${Math.round(progress)}%`;
            
            currentStep = step;
            document.getElementById('current_step').value = step;
        }

        // Handle next step buttons
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                const step = parseInt(this.getAttribute('data-step'));
                
                if (step === 3) {
                    const missingFiles = checkMissingFiles();
                    if (missingFiles.length > 0) {
                        showMissingFilesWarning(missingFiles);
                        return;
                    }
                }
                
                saveStep(step);
            });
        });

        // Handle previous step buttons
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                const step = parseInt(this.getAttribute('data-step'));
                goToStep(step - 1);
            });
        });

        // Handle save draft buttons
        document.querySelectorAll('#save-draft-btn, #save-draft-btn-survey').forEach(button => {
            button.addEventListener('click', function() {
                saveStep(currentStep, true);
            });
        });

        // Function to check missing files
        function checkMissingFiles() {
            const requiredFiles = {
                'surat_tugas': 'Surat Tugas',
                'sertifikat': 'Sertifikat',
                'foto_dokumentasi': 'Foto Dokumentasi',
                'surat_tugas_pembimbing': 'Surat Tugas Pembimbing',
                'bukti_sipsmart': 'Bukti SIPSMART'
            };

            return Object.entries(requiredFiles)
                .filter(([key, label]) => {
                    const inputs = key === 'surat_tugas_pembimbing' 
                        ? document.querySelector(`input[name="${key}"]`)
                        : document.querySelectorAll(`input[name="${key}[]"]`).length === 0;
                    return key === 'surat_tugas_pembimbing' ? !inputs : inputs;
                })
                .map(([_, label]) => label);
        }

        // Function to show missing files warning
        function showMissingFilesWarning(missingFiles) {
            const missingFilesList = missingFiles.map(file => 
                `<li class="text-danger">${file}</li>`).join('');
            
            Swal.fire({
                icon: 'warning',
                title: 'Dokumen Belum Lengkap',
                html: `
                    <p>Dokumen berikut belum diunggah:</p>
                    <ul style="text-align: left; margin-top: 10px;">${missingFilesList}</ul>
                    <p class="mt-3">Anda dapat:</p>
                    <ul style="text-align: left;">
                        <li>Klik "Simpan Draft" untuk menyimpan progres dan melanjutkan nanti</li>
                        <li>Klik "Lengkapi Dokumen" untuk mengunggah dokumen yang diperlukan</li>
                    </ul>
                `,
                showCancelButton: true,
                confirmButtonText: 'Lengkapi Dokumen',
                cancelButtonText: 'Simpan Draft'
            }).then((result) => {
                if (!result.isConfirmed) {
                    saveStep(currentStep, true);
                }
            });
        }

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (currentStep === 3) {
                const missingFiles = checkMissingFiles();
                if (missingFiles.length > 0) {
                    showMissingFilesWarning(missingFiles);
                    return;
                }
                goToStep(4);
                return;
            }

            if (currentStep === 4) {
                const surveyFields = ['informasi_lomba', 'tips_trik', 'bersedia_mentoring'];
                const missingFields = surveyFields.filter(field => {
                    const element = field === 'bersedia_mentoring' 
                        ? document.querySelector('input[name="bersedia_mentoring"]:checked')
                        : document.getElementById(field).value.trim();
                    return !element;
                });

                if (missingFields.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Survey Belum Lengkap',
                        text: 'Mohon lengkapi semua pertanyaan survey sebelum mengirimkan form.',
                        confirmButtonText: 'Lengkapi Survey'
                    });
                    return;
                }

                submitForm();
            }
        });

        function submitForm() {
            Swal.fire({
                title: 'Mengirimkan Data...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(form);
            if (draftId) {
                formData.append('draft_id', draftId);
            }

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                }
                // If not JSON, get the text and throw an error with it
                return response.text().then(text => {
                    throw new Error('Server returned non-JSON response: ' + text);
                });
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Data prestasi berhasil disimpan',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route("frontend.prestasi-mahasiswas.index") }}';
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: error.message || 'Gagal menyimpan data. Silakan coba lagi.',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        // Load draft data if draft_id exists
        if (draftId) {
            fetch('{{ route("frontend.prestasi-mahasiswas.get-draft") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ draft_id: draftId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.draft) {
                    const draft = data.draft;
                    
                    // Populate form fields
                    Object.entries(draft).forEach(([key, value]) => {
                        if (['surat_tugas_files', 'sertifikat_files', 'foto_dokumentasi_files', 
                             'surat_tugas_pembimbing_file', 'bukti_sipsmart_files', 'nama_peserta', 
                             'nim_peserta'].includes(key)) {
                            return;
                        }

                        const element = document.querySelector(`[name="${key}"]`);
                        if (element) {
                            if (element.type === 'radio') {
                                const radio = document.querySelector(`input[name="${key}"][value="${value}"]`);
                                if (radio) radio.checked = true;
                            } else if (element.type === 'select-one') {
                                element.value = value || '';
                            } else {
                                element.value = value || '';
                            }
                        }
                    });

                    // Handle peserta fields
                    if (draft.nama_peserta && Array.isArray(draft.nama_peserta)) {
                        // Remove existing peserta groups except the first one
                        const pesertaGroups = document.querySelectorAll('.peserta-group');
                        for (let i = pesertaGroups.length - 1; i > 0; i--) {
                            pesertaGroups[i].remove();
                        }

                        // Add peserta groups for each saved peserta
                        draft.nama_peserta.forEach((nama, index) => {
                            if (index === 0) {
                                // Update first peserta group
                                document.querySelector('input[name="nama_peserta[]"]').value = nama || '';
                                document.querySelector('input[name="nim_peserta[]"]').value = draft.nim_peserta[index] || '';
                            } else {
                                // Add new peserta groups
                                const addButton = document.querySelector('.add-peserta');
                                if (addButton) addButton.click();
                                
                                const groups = document.querySelectorAll('.peserta-group');
                                const lastGroup = groups[groups.length - 1];
                                if (lastGroup) {
                                    lastGroup.querySelector('input[name="nama_peserta[]"]').value = nama || '';
                                    lastGroup.querySelector('input[name="nim_peserta[]"]').value = draft.nim_peserta[index] || '';
                                }
                            }
                        });
                    }

                    // Restore files to dropzones
                    const fileCollections = {
                        'surat_tugas': draft.surat_tugas_files || [],
                        'sertifikat': draft.sertifikat_files || [],
                        'foto_dokumentasi': draft.foto_dokumentasi_files || [],
                        'bukti_sipsmart': draft.bukti_sipsmart_files || []
                    };

                    Object.entries(fileCollections).forEach(([key, files]) => {
                        const dropzone = Dropzone.forElement(`#${key}-dropzone`);
                        if (dropzone && files.length > 0) {
                            files.forEach(file => {
                                const mockFile = { name: file.name, size: file.size };
                                dropzone.emit('addedfile', mockFile);
                                if (file.url && (key === 'foto_dokumentasi' || key === 'bukti_sipsmart')) {
                                    dropzone.emit('thumbnail', mockFile, file.url);
                                }
                                dropzone.emit('complete', mockFile);
                                dropzone.files.push(mockFile);
                                $('form').append(`<input type="hidden" name="${key}[]" value="${file.name}">`);
                            });
                        }
                    });

                    // Handle single file upload (surat_tugas_pembimbing)
                    if (draft.surat_tugas_pembimbing_file) {
                        const dropzone = Dropzone.forElement('#surat_tugas_pembimbing-dropzone');
                        const file = draft.surat_tugas_pembimbing_file;
                        if (dropzone && file) {
                            const mockFile = { name: file.name, size: file.size };
                            dropzone.emit('addedfile', mockFile);
                            dropzone.emit('complete', mockFile);
                            dropzone.files.push(mockFile);
                            $('form').append(`<input type="hidden" name="surat_tugas_pembimbing" value="${file.name}">`);
                        }
                    }

                    // Go to saved step or first step
                    const savedStep = parseInt(draft.current_step) || 1;
                    goToStep(savedStep);

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Draft Dimuat',
                        text: 'Data draft berhasil dimuat',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'Failed to load draft data');
                }
            })
            .catch(error => {
                console.error('Error loading draft:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data draft: ' + error.message,
                    confirmButtonText: 'Tutup'
                });
            });
        }
    });
</script>

@include('frontend.prestasiMahasiswas.partials.dropzone-config')
@endsection
