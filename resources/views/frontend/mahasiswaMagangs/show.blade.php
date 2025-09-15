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
                    {{ trans('global.show') }} {{ trans('cruds.mahasiswaMagang.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mahasiswa-magangs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                            

                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%">
                                        {{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->mahasiswa->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.nim') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->nim }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.nama') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.semester') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->semester }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.bidang') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MahasiswaMagang::BIDANG_SELECT[$mahasiswaMagang->bidang] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.magang') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->magang->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.instansi') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->instansi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.alamat_instansi') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->alamat_instansi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.approve') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.approved_by') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->approved_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.pretest') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $mahasiswaMagang->pretest ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.posttest') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $mahasiswaMagang->posttest ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->dosen_pembimbing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.laporan_akhir') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->laporan_akhir as $key => $media)
                                            <div class="file-actions mb-2">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $media->getUrl() }}" 
                                                        data-name="{{ $media->name }}"
                                                        data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.presensi') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->presensi as $key => $media)
                                            <div class="file-actions mb-2">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $media->getUrl() }}" 
                                                        data-name="{{ $media->name }}"
                                                        data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.sertifikat') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->sertifikat as $key => $media)
                                            <div class="file-actions mb-2">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $media->getUrl() }}" 
                                                        data-name="{{ $media->name }}"
                                                        data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        KHS (Kartu Hasil Studi)
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->khs)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->khs->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->khs->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->khs->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->khs->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        KRS (Kartu Rencana Studi)
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->krs)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->krs->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->krs->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->krs->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->krs->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Form Persetujuan Dosen PA
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->form_persetujuan_dosen_pa)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->form_persetujuan_dosen_pa->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Surat Persetujuan Rekognisi
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->surat_persetujuan_rekognisi)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->surat_persetujuan_rekognisi->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Logbook MBKM
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->logbook_mbkm)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->logbook_mbkm->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->logbook_mbkm->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->form_penilaian_pembimbing_lapangan)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->form_penilaian_pembimbing_lapangan->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->form_penilaian_dosen_pembimbing)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->form_penilaian_dosen_pembimbing->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->berita_acara_seminar)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->berita_acara_seminar->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->berita_acara_seminar->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->presensi_kehadiran_seminar as $key => $media)
                                            <div class="file-actions mb-2">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $media->getUrl() }}" 
                                                        data-name="{{ $media->name }}"
                                                        data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->notulen_pertanyaan)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->notulen_pertanyaan->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->notulen_pertanyaan->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->tanda_bukti_penyerahan_laporan)
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" 
                                                        data-name="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->name }}"
                                                        data-type="{{ pathinfo($mahasiswaMagang->tanda_bukti_penyerahan_laporan->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->berkas_magang as $key => $media)
                                            <div class="file-actions mb-2">
                                                <button type="button" class="btn btn-sm btn-primary preview-file" 
                                                        data-url="{{ $media->getUrl() }}" 
                                                        data-name="{{ $media->name }}"
                                                        data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                    <i class="fas fa-eye"></i> Preview
                                                </button>
                                                <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-external-link-alt"></i> {{ trans('global.view_file') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.verified') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MahasiswaMagang::VERIFIED_SELECT[$mahasiswaMagang->verified] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.verified_by') }}
                                    </th>
                                    <td>
                                        {{ $mahasiswaMagang->verified_by->name ?? '' }}
                                    </td>
                                </tr>
                                <!-- Add verification notes row -->
                                @if($mahasiswaMagang->verification_notes)
                                <tr>
                                    <th>
                                        Verification Notes
                                    </th>
                                    <td>
                                        <div class="verification-notes p-2 bg-light border rounded">
                                            {{ $mahasiswaMagang->verification_notes }}
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                <!-- End verification notes row -->
                            </tbody>
                        </table>
                        
                        <!-- Monitoring Magang Section -->
                        @if($mahasiswaMagang->mahasiswa_id == auth()->id() && $mahasiswaMagang->approve == 'APPROVED')
                        <div class="card mt-4">
                            <div class="card-header">
                                Monitoring Magang
                                <a href="{{ route('frontend.monitoring-magangs.create', ['magang_id' => $mahasiswaMagang->id]) }}" class="btn btn-sm btn-success float-right">
                                    <i class="fa fa-plus"></i> Add Monitoring
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Place</th>
                                                <th>Supervisor</th>
                                                <th>Evidence</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($mahasiswaMagang->monitorings as $monitoring)
                                            <tr>
                                                <td>{{ $monitoring->tanggal }}</td>
                                                <td>{{ $monitoring->tempat }}</td>
                                                <td>{{ $monitoring->dospem->nama ?? $monitoring->pembimbing ?? '' }}</td>
                                                <td>
                                                    @foreach($monitoring->bukti as $media)
                                                    <div class="file-actions d-inline-block mr-1">
                                                        <button type="button" class="btn btn-xs btn-primary preview-file" 
                                                                data-url="{{ $media->getUrl() }}" 
                                                                data-name="{{ $media->name }}"
                                                                data-type="{{ pathinfo($media->file_name, PATHINFO_EXTENSION) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-xs btn-info">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                    </div>
                                                    @endforeach
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
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No monitoring records found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Monitoring Magang Section -->
                        
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mahasiswa-magangs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add pretest/posttest buttons section -->
            @if(auth()->user()->id == $mahasiswaMagang->mahasiswa_id)
            <div class="card">
                <div class="card-header">
                    Assessment Tests
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
                                <div class="card-header bg-info text-white">
                                    Post-Test
                                </div>
                                <div class="card-body">
                                    <p>Ujian setelah menyelesaikan program magang untuk mengukur perkembangan Anda.</p>
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
            <!-- End pretest/posttest buttons section -->

        </div>
    </div>
</div>

<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewModalLabel">File Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px;">
                <div id="previewContent" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" id="downloadFileBtn" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download"></i> Download File
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle preview file button clicks
    $('.preview-file').on('click', function() {
        var fileUrl = $(this).data('url');
        var fileName = $(this).data('name');
        var fileType = $(this).data('type').toLowerCase();
        
        // Set modal title and download link
        $('#filePreviewModalLabel').text('Preview: ' + fileName);
        $('#downloadFileBtn').attr('href', fileUrl);
        
        // Show modal
        $('#filePreviewModal').modal('show');
        
        // Show loading spinner
        $('#previewContent').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
        
        // Generate preview based on file type
        if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileType)) {
            // Image preview
            $('#previewContent').html('<img src="' + fileUrl + '" class="img-fluid" alt="' + fileName + '" style="max-height: 70vh;">');
        } else if (fileType === 'pdf') {
            // PDF preview
            $('#previewContent').html('<iframe src="' + fileUrl + '" width="100%" height="600px" style="border: none;"></iframe>');
        } else if (['doc', 'docx'].includes(fileType)) {
            // Word document preview using Google Docs Viewer
            var viewerUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(fileUrl);
            $('#previewContent').html('<iframe src="' + viewerUrl + '" width="100%" height="600px" style="border: none;"></iframe>');
        } else if (['xls', 'xlsx'].includes(fileType)) {
            // Excel preview using Google Sheets Viewer
            var viewerUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(fileUrl);
            $('#previewContent').html('<iframe src="' + viewerUrl + '" width="100%" height="600px" style="border: none;"></iframe>');
        } else if (['ppt', 'pptx'].includes(fileType)) {
            // PowerPoint preview using Google Docs Viewer
            var viewerUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(fileUrl);
            $('#previewContent').html('<iframe src="' + viewerUrl + '" width="100%" height="600px" style="border: none;"></iframe>');
        } else if (fileType === 'txt') {
            // Text file preview
            $.get(fileUrl, function(data) {
                $('#previewContent').html('<pre style="text-align: left; white-space: pre-wrap; max-height: 600px; overflow-y: auto;">' + $('<div>').text(data).html() + '</pre>');
            }).fail(function() {
                $('#previewContent').html('<div class="alert alert-warning">Cannot preview this text file. <a href="' + fileUrl + '" target="_blank">Click here to download</a></div>');
            });
        } else {
            // Unsupported file type
            $('#previewContent').html('<div class="alert alert-info"><i class="fas fa-file"></i><br><br>Preview not available for this file type.<br><br><strong>File:</strong> ' + fileName + '<br><strong>Type:</strong> ' + fileType.toUpperCase() + '<br><br><a href="' + fileUrl + '" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download File</a></div>');
        }
    });
    
    // Clear modal content when closed
    $('#filePreviewModal').on('hidden.bs.modal', function() {
        $('#previewContent').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
    });
});
</script>
@endsection