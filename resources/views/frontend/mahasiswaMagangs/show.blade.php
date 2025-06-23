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
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.presensi') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->presensi as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.sertifikat') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->sertifikat as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.form_penilaian_pembimbing_lapangan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->form_penilaian_pembimbing_lapangan)
                                            <a href="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.form_penilaian_dosen_pembimbing') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->form_penilaian_dosen_pembimbing)
                                            <a href="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.berita_acara_seminar') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->berita_acara_seminar)
                                            <a href="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.presensi_kehadiran_seminar') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->presensi_kehadiran_seminar as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.notulen_pertanyaan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->notulen_pertanyaan)
                                            <a href="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.tanda_bukti_penyerahan_laporan') }}
                                    </th>
                                    <td>
                                        @if($mahasiswaMagang->tanda_bukti_penyerahan_laporan)
                                            <a href="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}
                                    </th>
                                    <td>
                                        @foreach($mahasiswaMagang->berkas_magang as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
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
                                                <td>{{ $monitoring->pembimbing }}</td>
                                                <td>
                                                    @foreach($monitoring->bukti as $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-xs btn-info">
                                                        <i class="fa fa-file"></i>
                                                    </a>
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
@endsection