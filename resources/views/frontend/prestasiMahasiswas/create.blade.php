@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa - CDC Fakultas Psikologi UNS')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ isset($prestasiMahasiswa) ? 'Edit' : 'Prestasi Mahasiswa Baru' }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.prestasi-mahasiswas.index') }}">Prestasi Mahasiswa</a></li>
                <li class="breadcrumb-item active">{{ isset($prestasiMahasiswa) ? 'Edit' : 'Tambah' }} Prestasi</li>
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
                    <h4 class="mb-0">{{ isset($prestasiMahasiswa) ? 'Edit' : 'Tambah' }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}</h4>
                </div>

                <div class="card-body">
                    <form id="multiStepForm" method="POST" action="{{ route('frontend.prestasi-mahasiswas.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Hidden inputs for draft functionality -->
                        <input type="hidden" name="is_draft" id="is_draft" value="0">
                        <input type="hidden" name="current_step" id="current_step" value="{{ old('current_step', isset($prestasiMahasiswa) ? $prestasiMahasiswa->current_step : 1) }}">
                        @if(isset($prestasiMahasiswa))
                            <input type="hidden" name="prestasi_mahasiswa_id" value="{{ $prestasiMahasiswa->id }}">
                        @endif
                        
                        <!-- Progress bar -->
                        <div class="progressbar-wrapper mb-4">
                            <div class="progressbar">
                                <div class="progress" id="progress"></div>
                                <div class="progress-step active" data-title="Informasi Dasar"></div>
                                <div class="progress-step" data-title="Detail Kegiatan"></div>
                                <div class="progress-step" data-title="Peserta"></div>
                                <div class="progress-step" data-title="Dokumen"></div>
                                <div class="progress-step" data-title="Survey"></div>
                            </div>
                        </div>

                        <!-- Step 1: Basic Information -->
                        <div class="form-step active" data-step="1">
                            <h3 class="text-center mb-4">Informasi Dasar</h3>
                            
                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="skim_{{ $key }}" name="skim" class="custom-control-input" value="{{ $key }}" {{ old('skim', isset($prestasiMahasiswa) ? $prestasiMahasiswa->skim : '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="skim_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @if($errors->has('skim'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('skim') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="tingkat_{{ $key }}" name="tingkat" class="custom-control-input" value="{{ $key }}" {{ old('tingkat', isset($prestasiMahasiswa) ? $prestasiMahasiswa->tingkat : '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="tingkat_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @if($errors->has('tingkat'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('tingkat') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group text-right mt-4">
                                <button type="button" class="btn btn-primary btn-lg next-btn ml-2">
                                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Activity Details -->
                        <div class="form-step" data-step="2">
                            <h3 class="text-center mb-4">Detail Kegiatan</h3>

                            <div class="form-group">
                                <label class="required font-weight-bold" for="nama_kegiatan">{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</label>
                                <input class="form-control form-control-lg {{ $errors->has('nama_kegiatan') ? 'is-invalid' : '' }}" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', isset($prestasiMahasiswa) ? $prestasiMahasiswa->nama_kegiatan : '') }}" required>
                                @if($errors->has('nama_kegiatan'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_kegiatan') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="kategori_id">{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</label>
                                <select class="form-control select2 {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}" name="kategori_id" id="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $id => $entry)
                                        <option value="{{ $id }}" {{ old('kategori_id', isset($prestasiMahasiswa) ? $prestasiMahasiswa->kategori_id : '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('kategori_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('kategori_id') }}
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_awal">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}</label>
                                        <input class="form-control date {{ $errors->has('tanggal_awal') ? 'is-invalid' : '' }}" type="text" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal', isset($prestasiMahasiswa) ? $prestasiMahasiswa->tanggal_awal : '') }}">
                                        @if($errors->has('tanggal_awal'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tanggal_awal') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_akhir">{{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}</label>
                                        <input class="form-control date {{ $errors->has('tanggal_akhir') ? 'is-invalid' : '' }}" type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', isset($prestasiMahasiswa) ? $prestasiMahasiswa->tanggal_akhir : '') }}">
                                        @if($errors->has('tanggal_akhir'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tanggal_akhir') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}</label>
                                <div class="d-flex flex-wrap">
                                @foreach(App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="jumlah_peserta_{{ $key }}" name="jumlah_peserta" class="custom-control-input" value="{{ $key }}" {{ old('jumlah_peserta', isset($prestasiMahasiswa) ? $prestasiMahasiswa->jumlah_peserta : '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="jumlah_peserta_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                </div>
                                @if($errors->has('jumlah_peserta'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('jumlah_peserta') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta_helper') }}</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama_penyelenggara">Nama Penyelenggara</label>
                                        <input class="form-control {{ $errors->has('nama_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ old('nama_penyelenggara', isset($prestasiMahasiswa) ? $prestasiMahasiswa->nama_penyelenggara : '') }}">
                                        @if($errors->has('nama_penyelenggara'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nama_penyelenggara') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tempat_penyelenggara">Tempat Penyelenggara</label>
                                        <input class="form-control {{ $errors->has('tempat_penyelenggara') ? 'is-invalid' : '' }}" type="text" name="tempat_penyelenggara" id="tempat_penyelenggara" value="{{ old('tempat_penyelenggara', isset($prestasiMahasiswa) ? $prestasiMahasiswa->tempat_penyelenggara : '') }}">
                                        @if($errors->has('tempat_penyelenggara'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tempat_penyelenggara') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required font-weight-bold" for="perolehan_juara">Perolehan Juara</label>
                                <select class="form-control select2 {{ $errors->has('perolehan_juara') ? 'is-invalid' : '' }}" name="perolehan_juara" id="perolehan_juara" required>
                                    <option value="">Pilih Perolehan Juara</option>
                                    @foreach(App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('perolehan_juara', isset($prestasiMahasiswa) ? $prestasiMahasiswa->perolehan_juara : '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('perolehan_juara'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('perolehan_juara') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <div>
                                    <button type="button" class="btn btn-primary btn-lg next-btn ml-2">
                                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Participant Information -->
                        <div class="form-step" data-step="3">
                            <h3 class="text-center mb-4">Informasi Peserta</h3>

                            <div class="form-group">
                                <label class="required font-weight-bold">{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</label>
                                <div class="d-flex flex-wrap">
                                    @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                                        <div class="custom-control custom-radio custom-control-inline mb-2">
                                            <input type="radio" id="keikutsertaan_{{ $key }}" name="keikutsertaan" class="custom-control-input keikutsertaan-radio" value="{{ $key }}" {{ old('keikutsertaan', isset($prestasiMahasiswa) ? $prestasiMahasiswa->keikutsertaan : '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="custom-control-label" for="keikutsertaan_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @if($errors->has('keikutsertaan'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('keikutsertaan') }}
                                    </div>
                                @endif
                            </div>

                            <div id="peserta-wrapper">
                                <div class="card mb-3 peserta-group">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 card-title">Peserta 1</h5>
                                        <div class="ml-auto">
                                            <button type="button" class="btn btn-danger btn-sm remove-peserta" style="display: none;">
                                                <i class="fas fa-times"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="nama_peserta_0">Nama Peserta</label>
                                                    <input class="form-control" type="text" name="peserta[0][nama]" id="nama_peserta_0" value="{{ old('peserta.0.nama', isset($prestasiMahasiswa) && $prestasiMahasiswa->pesertas->count() > 0 ? $prestasiMahasiswa->pesertas[0]->nama : '') }}" required>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="nim_peserta_0">NIM Peserta</label>
                                                    <input class="form-control" type="text" name="peserta[0][nim]" id="nim_peserta_0" value="{{ old('peserta.0.nim', isset($prestasiMahasiswa) && $prestasiMahasiswa->pesertas->count() > 0 ? $prestasiMahasiswa->pesertas[0]->nim : '') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Peserta -->
                            <div class="text-center mb-4" id="addPesertaWrapper">
                                <button type="button" class="btn btn-success add-peserta" id="addPesertaBtn" style="display: none;">
                                    <i class="fas fa-plus"></i> Tambah Peserta
                                </button>
                                <div class="mt-2">
                                    <small class="text-muted" id="pesertaHelper">*Pilih "Tim/Kelompok" untuk menambah peserta</small>
                                </div>
                            </div>

                                        <div class="form-group">
                <label class="font-weight-bold" for="dosen_pembimbing">Dosen Pembimbing</label>
                <select class="form-control select2 {{ $errors->has('dosen_pembimbing') ? 'is-invalid' : '' }}" name="dosen_pembimbing" id="dosen_pembimbing">
                    <option value="">Pilih Dosen Pembimbing</option>
                    @foreach($dospems as $id => $entry)
                        <option value="{{ $id }}" {{ old('dosen_pembimbing', isset($prestasiMahasiswa) ? $prestasiMahasiswa->dosen_pembimbing : '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('dosen_pembimbing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dosen_pembimbing') }}
                    </div>
                @endif
            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="url_publikasi">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}</label>
                                <input class="form-control {{ $errors->has('url_publikasi') ? 'is-invalid' : '' }}" type="url" name="url_publikasi" id="url_publikasi" value="{{ old('url_publikasi', isset($prestasiMahasiswa) ? $prestasiMahasiswa->url_publikasi : '') }}">
                                @if($errors->has('url_publikasi'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('url_publikasi') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.url_publikasi_helper') }}</small>
                            </div>

                            <div class="form-group">
                                <label class="required font-weight-bold" for="no_wa">{{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}</label>
                                <input class="form-control {{ $errors->has('no_wa') ? 'is-invalid' : '' }}" type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', isset($prestasiMahasiswa) ? $prestasiMahasiswa->no_wa : '') }}" required>
                                @if($errors->has('no_wa'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_wa') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.no_wa_helper') }}</small>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary save-draft-btn" id="draftBtnStep3">
                                        <i class="fas fa-save mr-2"></i>Simpan Draft
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg next-btn ml-2">
                                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Documents -->
                        <div class="form-step" data-step="4">
                            <h3 class="text-center mb-4">Dokumen Pendukung</h3>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Info:</strong> Anda dapat menyimpan draft kapan saja dan melanjutkan upload dokumen nanti. Pastikan semua dokumen sudah terupload sebelum submit final.
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}</label>
                                <div class="needsclick dropzone" id="surat_tugas-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah surat tugas di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                                @if($errors->has('surat_tugas'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('surat_tugas') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_helper') }}</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="sertifikat">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}</label>
                                <div class="needsclick dropzone" id="sertifikat-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah sertifikat di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                                @if($errors->has('sertifikat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('sertifikat') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat_helper') }}</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="foto_dokumentasi">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}</label>
                                <div class="needsclick dropzone" id="foto_dokumentasi-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah foto dokumentasi di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                                @if($errors->has('foto_dokumentasi'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto_dokumentasi') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi_helper') }}</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="surat_tugas_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}</label>
                                <div class="needsclick dropzone" id="surat_tugas_pembimbing-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah surat tugas pembimbing di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                                @if($errors->has('surat_tugas_pembimbing'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('surat_tugas_pembimbing') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing_helper') }}</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="bukti_sipsmart">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}</label>
                                <div class="needsclick dropzone" id="bukti_sipsmart-dropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                        <h4>Unggah bukti SIPSMART di sini</h4>
                                        <p class="text-muted">Klik atau seret file ke area ini</p>
                                    </div>
                                </div>
                                @if($errors->has('bukti_sipsmart'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('bukti_sipsmart') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart_helper') }}</small>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary save-draft-btn" id="draftBtnStep4">
                                        <i class="fas fa-save mr-2"></i>Simpan Draft
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg next-btn ml-2">
                                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Survey -->
                        <div class="form-step" data-step="5">
                            <h3 class="text-center mb-4">Survey Keberlanjutan</h3>
                            
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Survey ini</strong> akan membantu kami untuk memberikan informasi dan dukungan yang lebih baik untuk prestasi mahasiswa di tahun mendatang.
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="informasi_lomba">1. Darimana Anda mendapat informasi tentang lomba/kompetisi ini?</label>
                                <textarea class="form-control {{ $errors->has('informasi_lomba') ? 'is-invalid' : '' }}" name="informasi_lomba" id="informasi_lomba" rows="3" placeholder="Contoh: Media sosial, website resmi, teman, dosen, dll.">{{ old('informasi_lomba', isset($prestasiMahasiswa) ? $prestasiMahasiswa->informasi_lomba : '') }}</textarea>
                                @if($errors->has('informasi_lomba'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('informasi_lomba') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">Informasi ini membantu kami memahami saluran komunikasi yang efektif.</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="tips_trik">2. Apa tips dan trik Anda untuk memenangkan lomba/kompetisi?</label>
                                <textarea class="form-control {{ $errors->has('tips_trik') ? 'is-invalid' : '' }}" name="tips_trik" id="tips_trik" rows="4" placeholder="Bagikan pengalaman dan strategi Anda...">{{ old('tips_trik', isset($prestasiMahasiswa) ? $prestasiMahasiswa->tips_trik : '') }}</textarea>
                                @if($errors->has('tips_trik'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tips_trik') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">Tips Anda akan membantu junior dan adik tingkat untuk berprestasi.</small>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">3. Apakah Anda bersedia dihubungi untuk mentoring generasi selanjutnya?</label>
                                <div class="mt-2">
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="bersedia_mentoring_ya" name="bersedia_mentoring" class="custom-control-input" value="1" {{ old('bersedia_mentoring', isset($prestasiMahasiswa) ? $prestasiMahasiswa->bersedia_mentoring : '') === '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="bersedia_mentoring_ya">
                                            <strong>Ya, saya bersedia</strong> - Saya ingin membantu adik tingkat untuk berprestasi
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="bersedia_mentoring_tidak" name="bersedia_mentoring" class="custom-control-input" value="0" {{ old('bersedia_mentoring', isset($prestasiMahasiswa) ? $prestasiMahasiswa->bersedia_mentoring : '') === '0' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="bersedia_mentoring_tidak">
                                            <strong>Tidak, untuk saat ini</strong> - Mungkin lain waktu
                                        </label>
                                    </div>
                                </div>
                                @if($errors->has('bersedia_mentoring'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('bersedia_mentoring') }}
                                    </div>
                                @endif
                                <small class="form-text text-muted">Mentoring dapat berupa sharing pengalaman, review proposal, atau konsultasi persiapan lomba.</small>
                            </div>

                            <div class="form-group d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary btn-lg prev-btn">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button class="btn btn-success btn-lg" type="submit" id="finalSubmitBtn">
                                    <i class="fas fa-check mr-2"></i> Selesai & Kirim
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
    const saveDraftBtns = document.querySelectorAll('.save-draft-btn');
    const progress = document.getElementById('progress');
    const progressSteps = document.querySelectorAll('.progress-step');
    
    let formStepsNum = {{ isset($prestasiMahasiswa) ? max(0, (int)$prestasiMahasiswa->current_step - 1) : 0 }};
    let filesUploaded = false;
    let canSaveDraft = true;

    // Participant management variables - declare early
    const keikutsertaanRadios = document.querySelectorAll('.keikutsertaan-radio');
    const addPesertaBtn = document.querySelector('.add-peserta');
    const pesertaHelper = document.getElementById('pesertaHelper');
    let pesertaWrapper = document.getElementById('peserta-wrapper');
    let pesertaIndex = 0;

    // Validate and adjust formStepsNum to be within valid bounds
    if (formStepsNum < 0) formStepsNum = 0;
    if (formStepsNum >= formSteps.length) formStepsNum = formSteps.length - 1;
    
    console.log('Initial formStepsNum:', formStepsNum, 'Total steps:', formSteps.length);

    // Define helper functions first
    function updateFormSteps() {
        console.log('updateFormSteps called, current formStepsNum:', formStepsNum);
        formSteps.forEach(step => {
            step.classList.remove('active');
        });
        if (formSteps[formStepsNum]) {
            formSteps[formStepsNum].classList.add('active');
            console.log('Activated step:', formStepsNum + 1);
        } else {
            console.error('Step not found:', formStepsNum);
        }
    }
    
    function updateProgressBar() {
        console.log('updateProgressBar called, formStepsNum:', formStepsNum);
        progressSteps.forEach((step, idx) => {
            if (idx <= formStepsNum) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        
        progress.style.width = ((formStepsNum) / (progressSteps.length - 1)) * 100 + '%';
        console.log('Progress bar set to:', ((formStepsNum) / (progressSteps.length - 1)) * 100 + '%');
    }

    function updateCurrentStep() {
        document.getElementById('current_step').value = formStepsNum + 1;
        console.log('Current step input updated to:', formStepsNum + 1);
    }

    function updateRemoveButtonsVisibility() {
        const pesertaGroups = document.querySelectorAll('.peserta-group');
        const isKelompok = document.querySelector('input[name="keikutsertaan"]:checked')?.value === 'kelompok';
        
        pesertaGroups.forEach((group, index) => {
            const removeBtn = group.querySelector('.remove-peserta');
            if (removeBtn) {
                if (isKelompok) {
                    // Untuk tim/kelompok: sembunyikan tombol hapus untuk 2 peserta pertama
                    removeBtn.style.display = index < 2 ? 'none' : 'inline-block';
                } else {
                    // Untuk individu: sembunyikan tombol hapus untuk peserta pertama
                    removeBtn.style.display = index === 0 ? 'none' : 'inline-block';
                }
            }
        });
    }

    // Initialize form with existing data when editing
    @if(isset($prestasiMahasiswa))
        // Populate additional participants if editing
        @if($prestasiMahasiswa->pesertas->count() > 1)
            // Use the existing pesertaWrapper variable - don't redeclare
            let tempPesertaIndex = 0;
            
            @foreach($prestasiMahasiswa->pesertas->slice(1) as $index => $peserta)
                tempPesertaIndex++;
                const newPesertaHtml = `
                    <div class="card mb-3 peserta-group">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 card-title">Peserta ${tempPesertaIndex + 1}</h5>
                            <div class="ml-auto">
                                <button type="button" class="btn btn-danger btn-sm remove-peserta">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama_peserta_${tempPesertaIndex}">Nama Peserta</label>
                                        <input class="form-control" type="text" name="peserta[${tempPesertaIndex}][nama]" id="nama_peserta_${tempPesertaIndex}" value="{{ $peserta->nama }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nim_peserta_${tempPesertaIndex}">NIM Peserta</label>
                                        <input class="form-control" type="text" name="peserta[${tempPesertaIndex}][nim]" id="nim_peserta_${tempPesertaIndex}" value="{{ $peserta->nim }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                pesertaWrapper.insertAdjacentHTML('beforeend', newPesertaHtml);
            @endforeach
            
            // Update the global pesertaIndex to match loaded participants
            pesertaIndex = tempPesertaIndex;
            
            // Show add button if kelompok is selected
            const keikutsertaanKelompok = document.getElementById('keikutsertaan_kelompok');
            if (keikutsertaanKelompok && keikutsertaanKelompok.checked) {
                addPesertaBtn.style.display = 'inline-block';
                pesertaHelper.textContent = '*Klik tombol di atas untuk menambah peserta';
            }
            
            updateRemoveButtonsVisibility();
        @endif
        
        // IMPORTANT: Always initialize form display when loading existing data
        console.log('Initializing form for existing record, step:', formStepsNum + 1);
        updateFormSteps();
        updateProgressBar();
        updateCurrentStep();
    @else
        // Initialize for new records (should start at step 1)
        console.log('Initializing form for new record, step:', formStepsNum + 1);
        updateFormSteps();
        updateProgressBar();
        updateCurrentStep();
    @endif

    // Track file uploads - but don't lock draft functionality
    function trackFileUpload() {
        filesUploaded = true;
        // Remove the draft locking - users should be able to save even with partial uploads
        
        // Show notification about partial upload
        showNotification('success', 'File berhasil diunggah. Anda tetap dapat menyimpan draft dan melanjutkan nanti.');
    }

    // Form navigation
    console.log('Setting up navigation buttons...');
    console.log('Next buttons found:', nextBtns.length);
    console.log('Previous buttons found:', prevBtns.length);
    console.log('Form steps found:', formSteps.length);
    
    nextBtns.forEach((btn, index) => {
        console.log(`Attaching click listener to next button ${index + 1}:`, btn);
        btn.addEventListener('click', (e) => {
            console.log('Next button clicked, current step:', formStepsNum + 1);
            
            // Add debug bypass (hold Ctrl+Click to skip validation)
            const skipValidation = e.ctrlKey;
            if (skipValidation) {
                console.log('🚀 DEBUG: Skipping validation (Ctrl+Click detected)');
            formStepsNum++;
            updateFormSteps();
            updateProgressBar();
                updateCurrentStep();
                return;
            }
            
            if (validateCurrentStep()) {
                console.log('Validation passed, moving to next step');
                formStepsNum++;
                updateFormSteps();
                updateProgressBar();
                updateCurrentStep();
            } else {
                console.log('Validation failed, staying on current step');
            }
        });
    });
    
    prevBtns.forEach((btn, index) => {
        console.log(`Attaching click listener to previous button ${index + 1}:`, btn);
        btn.addEventListener('click', () => {
            console.log('Previous button clicked, current step:', formStepsNum + 1);
            formStepsNum--;
            updateFormSteps();
            updateProgressBar();
            updateCurrentStep();
        });
    });
    
    // Draft saving functionality
    let isSavingDraft = false; // Flag to prevent duplicate saves
    
    saveDraftBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (isSavingDraft) {
                console.log('Draft save already in progress, ignoring click');
                return;
            }
            saveDraft();
        });
    });

    // Add click handler for save draft buttons that might be added dynamically
    document.addEventListener('click', function(e) {
        if (e.target.closest('.save-draft-btn')) {
            e.preventDefault();
            if (isSavingDraft) {
                console.log('Draft save already in progress, ignoring dynamic click');
                return;
            }
            saveDraft();
        }
    });

    function saveDraft() {
        // Prevent multiple simultaneous saves
        if (isSavingDraft) {
            console.log('Draft save already in progress, exiting');
            return;
        }
        
        // Validate current step before saving
        if (!validateCurrentStep()) {
            showNotification('warning', 'Mohon lengkapi data yang diperlukan sebelum menyimpan draft.');
            return;
        }
        
        // Set saving flag and disable buttons
        isSavingDraft = true;
        const allSaveBtns = document.querySelectorAll('.save-draft-btn');
        allSaveBtns.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        });
        
        // Debug: Check current state of prestasi_mahasiswa_id field
        const existingIdField = document.querySelector('input[name="prestasi_mahasiswa_id"]');
        console.log('=== DRAFT SAVE DEBUG ===');
        console.log('Existing prestasi_mahasiswa_id field:', existingIdField);
        console.log('Current value:', existingIdField ? existingIdField.value : 'NOT FOUND');
        
        // Set draft mode and current step
        document.getElementById('is_draft').value = '1';
        document.getElementById('current_step').value = formStepsNum + 1;
        
        // Create FormData object
        const formData = new FormData(document.getElementById('multiStepForm'));
        
        // Debug: Check if prestasi_mahasiswa_id is in the form data
        console.log('prestasi_mahasiswa_id in FormData:', formData.get('prestasi_mahasiswa_id'));
        
        // Debug: Log form data being sent (first 15 entries)
        console.log('Draft data being sent:');
        let count = 0;
        for (let [key, value] of formData.entries()) {
            if (count < 15) { // Limit logging to avoid spam
                console.log(key, ':', value);
                count++;
            }
        }
        
        // Get CSRF token
        const csrfToken = document.querySelector('input[name="_token"]').value || 
                         document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            showNotification('error', 'CSRF token tidak ditemukan. Silakan refresh halaman.');
            resetSaveDraftState();
            return;
        }
        
        // Show loading
        showNotification('info', 'Menyimpan draft...');
        
        // Use the save-step route specifically for drafts
        const draftAction = '{{ route("frontend.prestasi-mahasiswas.save-step") }}';
        console.log('Saving draft to:', draftAction);
        console.log('Current step:', formStepsNum + 1);
        
        fetch(draftAction, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response URL:', response.url);
            
            // Handle redirects (status 302)
            if (response.redirected) {
                console.log('Request was redirected to:', response.url);
                showNotification('success', 'Draft berhasil disimpan! Redirect ke halaman berikutnya...');
                window.location.href = response.url;
                return;
            }
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response body:', text.substring(0, 1000));
                    
                    // Try to parse as JSON to get validation errors
                    try {
                        const errorData = JSON.parse(text);
                        if (errorData.message) {
                            throw new Error(errorData.message);
                        }
                        if (errorData.errors) {
                            const errorMessages = Object.values(errorData.errors).flat().join(', ');
                            throw new Error('Validation Error: ' + errorMessages);
                        }
                    } catch (parseError) {
                        // If not JSON or parsing failed, use original error
                        if (response.status === 422) {
                            throw new Error('Validation Error: Please check your input fields.');
                        }
                    }
                    
                    throw new Error(`HTTP ${response.status}: Server error occurred`);
                });
            }
            
            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                // If it's a successful HTML response (redirect), treat as success
                if (response.status === 200) {
                    return { success: true, message: 'Draft berhasil disimpan!' };
                }
                
                // If not JSON, get text to see what was returned
                return response.text().then(text => {
                    console.error('Expected JSON but got:', text.substring(0, 200));
                    
                    // If the response contains success indicators, treat as success
                    if (text.includes('success') || text.includes('berhasil')) {
                        return { success: true, message: 'Draft berhasil disimpan!' };
                    }
                    
                    throw new Error('Server returned unexpected response format.');
                });
            }
        })
        .then(data => {
            console.log('=== DRAFT SAVE RESPONSE ===');
            console.log('Success response:', data);
            
            if (data && data.success !== false) {
                showNotification('success', data.message || 'Draft berhasil disimpan!');
                
                // CRITICAL: Update form state with the draft ID to prevent duplicate records
                if (data.draft_id) {
                    console.log('Received draft_id from server:', data.draft_id);
                    
                    // Update or create the hidden field for future saves
                    let prestasiMahasiswaIdField = document.querySelector('input[name="prestasi_mahasiswa_id"]');
                    
                    if (!prestasiMahasiswaIdField) {
                        console.log('Creating new prestasi_mahasiswa_id hidden field');
                        // Create the hidden field if it doesn't exist
                        prestasiMahasiswaIdField = document.createElement('input');
                        prestasiMahasiswaIdField.type = 'hidden';
                        prestasiMahasiswaIdField.name = 'prestasi_mahasiswa_id';
                        prestasiMahasiswaIdField.id = 'prestasi_mahasiswa_id';
                        document.getElementById('multiStepForm').appendChild(prestasiMahasiswaIdField);
                        
                        // Show additional info for first-time draft save
                        setTimeout(() => {
                            showNotification('info', 'Draft ID ' + data.draft_id + ' sekarang tersimpan. Penyimpanan selanjutnya akan memperbarui draft ini.');
                        }, 2000);
                    } else {
                        console.log('Updating existing prestasi_mahasiswa_id field');
                    }
                    
                    // Set the value
                    prestasiMahasiswaIdField.value = data.draft_id;
                    console.log('Updated prestasi_mahasiswa_id field value to:', data.draft_id);
                    
                    // Double check it was set correctly
                    const verifyField = document.querySelector('input[name="prestasi_mahasiswa_id"]');
                    console.log('Verification - prestasi_mahasiswa_id field value is now:', verifyField ? verifyField.value : 'STILL NOT FOUND');
                } else {
                    console.warn('No draft_id received from server response');
                }
                
                // Optional: redirect to draft list or update UI
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                }
            } else {
                console.error('Server response:', data);
                showNotification('error', 'Gagal menyimpan draft: ' + (data.message || data.errors || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error saving draft:', error);
            // Be more user-friendly with error messages
            if (error.message.includes('Server returned unexpected response format')) {
                showNotification('warning', 'Draft mungkin sudah tersimpan. Silakan periksa daftar prestasi Anda.');
            } else {
                showNotification('error', 'Terjadi kesalahan saat menyimpan draft: ' + error.message);
            }
        })
        .finally(() => {
            // Always reset the saving state and re-enable buttons
            resetSaveDraftState();
        });
    }
    
    function resetSaveDraftState() {
        isSavingDraft = false;
        const allSaveBtns = document.querySelectorAll('.save-draft-btn');
        allSaveBtns.forEach(btn => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Draft';
        });
    }
    
    function validateCurrentStep() {
        console.log('=== Validating current step ===');
        console.log('formStepsNum:', formStepsNum);
        
        const currentStep = formSteps[formStepsNum];
        if (!currentStep) {
            console.error('Current step element not found for index:', formStepsNum);
            return false;
        }
        
        console.log('Current step element:', currentStep);
        const requiredFields = currentStep.querySelectorAll('input[required], select[required], textarea[required]');
        console.log('Required fields found:', requiredFields.length);
        
        let isValid = true;

        requiredFields.forEach((field, index) => {
            console.log(`Checking field ${index + 1}:`, field.name, field.type, field.value);
            
            if (field.type === 'radio') {
                const radioGroup = currentStep.querySelectorAll(`input[name="${field.name}"]`);
                const isRadioSelected = Array.from(radioGroup).some(radio => radio.checked);
                console.log(`Radio group ${field.name}: selected =`, isRadioSelected);
                
                if (!isRadioSelected) {
                    isValid = false;
                    field.closest('.form-group').classList.add('has-error');
                    console.log(`❌ Radio validation failed for: ${field.name}`);
                } else {
                    field.closest('.form-group').classList.remove('has-error');
                    console.log(`✅ Radio validation passed for: ${field.name}`);
                }
            } else if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
                console.log(`❌ Field validation failed for: ${field.name} (empty value)`);
            } else {
                field.classList.remove('is-invalid');
                console.log(`✅ Field validation passed for: ${field.name}`);
            }
        });

        // Validasi khusus untuk step peserta (step 2, index 2)
        if (formStepsNum === 2) {
            console.log('=== Special validation for participant step ===');
            const keikutsertaanValue = currentStep.querySelector('input[name="keikutsertaan"]:checked')?.value;
            const pesertaGroups = currentStep.querySelectorAll('.peserta-group');
            console.log('Keikutsertaan value:', keikutsertaanValue);
            console.log('Peserta groups found:', pesertaGroups.length);
            
            if (keikutsertaanValue === 'kelompok' && pesertaGroups.length < 2) {
                isValid = false;
                console.log('❌ Tim/Kelompok validation failed: insufficient participants');
                showNotification('error', 'Tim/Kelompok harus memiliki minimal 2 peserta.');
                return false;
            }
            
            // Validasi bahwa semua nama dan NIM peserta diisi
            pesertaGroups.forEach((group, index) => {
                const namaInput = group.querySelector('input[name^="peserta"][name$="[nama]"]');
                const nimInput = group.querySelector('input[name^="peserta"][name$="[nim]"]');
                
                console.log(`Checking participant ${index + 1}:`, {
                    nama: namaInput ? namaInput.value : 'not found',
                    nim: nimInput ? nimInput.value : 'not found'
                });
                
                if (namaInput && !namaInput.value.trim()) {
                    isValid = false;
                    namaInput.classList.add('is-invalid');
                    console.log(`❌ Participant ${index + 1} nama validation failed`);
                } else if (namaInput) {
                    namaInput.classList.remove('is-invalid');
                    console.log(`✅ Participant ${index + 1} nama validation passed`);
                }
                
                if (nimInput && !nimInput.value.trim()) {
                    isValid = false;
                    nimInput.classList.add('is-invalid');
                    console.log(`❌ Participant ${index + 1} nim validation failed`);
                } else if (nimInput) {
                    nimInput.classList.remove('is-invalid');
                    console.log(`✅ Participant ${index + 1} nim validation passed`);
                }
            });
        }

        console.log('=== Validation result:', isValid ? '✅ PASSED' : '❌ FAILED', '===');
        
        if (!isValid) {
            showNotification('error', 'Mohon lengkapi semua field yang diperlukan sebelum melanjutkan.');
        }

        return isValid;
    }

    // Peserta management
    keikutsertaanRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'kelompok') {
                addPesertaBtn.style.display = 'inline-block';
                if (pesertaHelper) {
                    pesertaHelper.textContent = '*Klik tombol di atas untuk menambah peserta';
                }
                
                // Pastikan ada minimal 2 peserta untuk tim/kelompok
                const currentPesertaGroups = document.querySelectorAll('.peserta-group');
                if (currentPesertaGroups.length < 2) {
                    addNewPeserta();
                }
                
                updateRemoveButtonsVisibility();
            } else {
                addPesertaBtn.style.display = 'none';
                if (pesertaHelper) {
                    pesertaHelper.textContent = '*Pilih "Tim/Kelompok" untuk menambah peserta';
                }
                
                // Remove additional peserta groups, keep only the first one
                const pesertaGroups = document.querySelectorAll('.peserta-group');
                Array.from(pesertaGroups).slice(1).forEach(group => group.remove());
                pesertaIndex = 0;
                updatePesertaTitles();
                updateRemoveButtonsVisibility();
            }
        });
    });

    function addNewPeserta() {
        pesertaIndex++;
        const newPesertaHtml = createPesertaCard(pesertaIndex);
        pesertaWrapper.insertAdjacentHTML('beforeend', newPesertaHtml);
        updateRemoveButtonsVisibility();
    }

    function createPesertaCard(index) {
        return `
            <div class="card mb-3 peserta-group">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Peserta ${index + 1}</h5>
                    <div class="ml-auto">
                    <button type="button" class="btn btn-danger btn-sm remove-peserta">
                            <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nama_peserta_${index}">Nama Peserta</label>
                                <input class="form-control" type="text" name="peserta[${index}][nama]" id="nama_peserta_${index}" required>
                    </div>
                        </div>
                        <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nim_peserta_${index}">NIM Peserta</label>
                                <input class="form-control" type="text" name="peserta[${index}][nim]" id="nim_peserta_${index}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Event listener untuk tombol tambah peserta
    if (addPesertaBtn) {
    addPesertaBtn.addEventListener('click', function() {
            addNewPeserta();
    });
    }

    // Event delegation untuk tombol hapus peserta
    pesertaWrapper.addEventListener('click', function(e) {
        if (e.target.closest('.remove-peserta')) {
            const pesertaGroups = document.querySelectorAll('.peserta-group');
            const isKelompok = document.querySelector('input[name="keikutsertaan"]:checked')?.value === 'kelompok';
            
            // Untuk tim/kelompok, minimal harus ada 2 peserta
            if (isKelompok && pesertaGroups.length <= 2) {
                showNotification('warning', 'Tim/Kelompok harus memiliki minimal 2 peserta.');
                return;
            }
            
            e.target.closest('.peserta-group').remove();
            updatePesertaTitles();
            updateRemoveButtonsVisibility();
        }
    });

    function updatePesertaTitles() {
        const pesertaGroups = document.querySelectorAll('.peserta-group');
        pesertaGroups.forEach((group, index) => {
            const title = group.querySelector('.card-title');
            if (title) {
                title.textContent = `Peserta ${index + 1}`;
            }
            
            // Update input names and IDs
            const inputs = group.querySelectorAll('input');
            inputs.forEach(input => {
                const nameAttr = input.getAttribute('name');
                if (nameAttr) {
                    const newName = nameAttr.replace(/\[\d+\]/, `[${index}]`);
                    input.setAttribute('name', newName);
                    
                    const newId = input.id.replace(/_\d+$/, `_${index}`);
                    input.id = newId;
                    
                    const label = group.querySelector(`label[for="${input.id}"]`);
                    if (label) {
                        label.setAttribute('for', newId);
                    }
                }
            });
        });
        
        // Update pesertaIndex to match the current count
        pesertaIndex = pesertaGroups.length - 1;
    }

    // Notification system
    function showNotification(type, message) {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.custom-notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show custom-notification`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 500px;
        `;
        
        notification.innerHTML = `
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    // Initialize components
    updateRemoveButtonsVisibility();

    // Initialize date picker
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    // Initialize select2
    $('.select2').select2();

    // Final form submission
    document.getElementById('finalSubmitBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        if (validateCurrentStep()) {
            document.getElementById('is_draft').value = '0';
            document.getElementById('multiStepForm').submit();
        }
    });
});

// Dropzone configurations with file upload tracking
var uploadedSuratTugasMap = {}
Dropzone.options.suratTugasDropzone = {
    url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="surat_tugas[]" value="' + response.name + '">')
      uploadedSuratTugasMap[file.name] = response.name
      window.trackFileUpload && window.trackFileUpload();
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
        var files = {!! json_encode($prestasiMahasiswa->surat_tugas) !!}
        for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            // Use the correct property name from Media object
            var fileName = file.file_name || file.name
            $('form').append('<input type="hidden" name="surat_tugas[]" value="' + fileName + '">')
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

var uploadedSertifikatMap = {}
Dropzone.options.sertifikatDropzone = {
    url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="sertifikat[]" value="' + response.name + '">')
      uploadedSertifikatMap[file.name] = response.name
      window.trackFileUpload && window.trackFileUpload();
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
        var files = {!! json_encode($prestasiMahasiswa->sertifikat) !!}
        for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            // Use the correct property name from Media object
            var fileName = file.file_name || file.name
            $('form').append('<input type="hidden" name="sertifikat[]" value="' + fileName + '">')
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

var uploadedFotoDokumentasiMap = {}
Dropzone.options.fotoDokumentasiDropzone = {
    url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + response.name + '">')
      uploadedFotoDokumentasiMap[file.name] = response.name
      window.trackFileUpload && window.trackFileUpload();
    },
    removedfile: function (file) {
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
            // Use thumbnail/preview for images
            if (file.thumbnail || file.preview || file.url) {
                this.options.thumbnail.call(this, file, file.thumbnail || file.preview || file.url)
            }
            file.previewElement.classList.add('dz-complete')
            // Use the correct property name from Media object
            var fileName = file.file_name || file.name
            $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + fileName + '">')
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

var uploadedSuratTugasPembimbingMap = {}
Dropzone.options.suratTugasPembimbingDropzone = {
    url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="surat_tugas_pembimbing"]').remove()
      $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + response.name + '">')
      uploadedSuratTugasPembimbingMap[file.name] = response.name
      window.trackFileUpload && window.trackFileUpload();
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
        if (file) {
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            // Use the correct property name from Media object
            var fileName = file.file_name || file.name
            $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + fileName + '">')
            this.options.maxFiles = this.options.maxFiles - 1
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

var uploadedBuktiSipsmartMap = {}
Dropzone.options.buktiSipsmartDropzone = {
    url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + response.name + '">')
      uploadedBuktiSipsmartMap[file.name] = response.name
      window.trackFileUpload && window.trackFileUpload();
    },
    removedfile: function (file) {
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
            // Use thumbnail/preview for images
            if (file.thumbnail || file.preview || file.url) {
                this.options.thumbnail.call(this, file, file.thumbnail || file.preview || file.url)
            }
            file.previewElement.classList.add('dz-complete')
            // Use the correct property name from Media object
            var fileName = file.file_name || file.name
            $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + fileName + '">')
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

// Make trackFileUpload globally available
window.trackFileUpload = function() {
    const event = new CustomEvent('fileUploaded');
    document.dispatchEvent(event);
};

// Users can now save drafts at any time, even with partial file uploads
// This allows them to save progress and complete document uploads later
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

/* Validation styles */
.has-error .custom-control-label {
    color: #dc3545;
}

.has-error .form-group {
    border-left: 3px solid #dc3545;
    padding-left: 10px;
}

/* Dropzone customization */
.dropzone {
    border: 2px dashed #007bff;
    border-radius: 5px;
    background: #f8fafc;
    text-align: center;
    padding: 30px;
    transition: border-color 0.3s ease;
}

.dropzone:hover {
    border-color: #0056b3;
}

.dropzone.dz-drag-hover {
    border-color: #28a745;
    background: #f8fff8;
}

.dz-message {
    margin: 1em 0;
}

/* Button improvements */
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

/* Custom radio improvements */
.custom-control-inline {
    margin-right: 1rem;
}

/* Add Peserta Button */
.add-peserta {
    margin: 15px 0;
    padding: 10px 20px;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.add-peserta:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Save Draft Button */
.save-draft-btn {
    padding: 8px 16px;
    font-weight: 500;
    border: 1px solid #6c757d;
    transition: all 0.3s ease;
}

.save-draft-btn:hover:not(:disabled) {
    background-color: #6c757d;
    color: white;
    transform: translateY(-1px);
}

.save-draft-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Survey styling */
.form-step[data-step="5"] {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    padding: 20px;
}

.form-step[data-step="5"] .alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border: none;
    border-left: 4px solid #17a2b8;
}

/* Participant cards styling */
.peserta-group {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    border-radius: 8px;
    overflow: hidden;
}

.peserta-group:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.peserta-group .card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
}

/* Form step transitions */
.form-step {
    opacity: 0;
    transform: translateX(50px);
    transition: all 0.5s ease;
}

.form-step.active {
    opacity: 1;
    transform: translateX(0);
}

/* Enhanced alert styles */
.alert {
    border-radius: 8px;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    color: #0c5460;
    border-left: 4px solid #17a2b8;
}

/* Button group styling */
.form-group .d-flex > div {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Custom notification positioning */
.custom-notification {
    animation: slideInRight 0.3s ease;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .progress-step::after {
        font-size: 0.7rem;
        top: 40px;
    }
    
    .form-group .d-flex {
        flex-direction: column;
    }
    
    .custom-control-inline {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection