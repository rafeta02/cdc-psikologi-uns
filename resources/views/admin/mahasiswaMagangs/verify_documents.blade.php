@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h3>Verify Internship Documents</h3>
                <h4 class="text-muted">{{ $mahasiswaMagang->nama }} ({{ $mahasiswaMagang->nim }})</h4>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-default" href="{{ route('admin.mahasiswa-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Internship Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">Student</th>
                                    <td>{{ $mahasiswaMagang->mahasiswa->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>{{ $mahasiswaMagang->nim }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $mahasiswaMagang->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Institution</th>
                                    <td>{{ $mahasiswaMagang->instansi }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Field</th>
                                    <td>{{ App\Models\MahasiswaMagang::BIDANG_SELECT[$mahasiswaMagang->bidang] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Academic Supervisor</th>
                                    <td>{{ $mahasiswaMagang->dosen_pembimbing }}</td>
                                </tr>
                                <tr>
                                    <th>Tests Status</th>
                                    <td>
                                        <div class="badge {{ $mahasiswaMagang->pretest ? 'badge-success' : 'badge-secondary' }} mb-1">
                                            Pretest: {{ $mahasiswaMagang->pretest ? 'Completed' : 'Pending' }}
                                        </div>
                                        <br>
                                        <div class="badge {{ $mahasiswaMagang->posttest ? 'badge-success' : 'badge-secondary' }}">
                                            Posttest: {{ $mahasiswaMagang->posttest ? 'Completed' : 'Pending' }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Verification Status</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.mahasiswa-magangs.process-verification', $mahasiswaMagang->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="verification_status">Status</label>
                                <select class="form-control" id="verification_status" name="verified">
                                    <option value="APPROVED" {{ $mahasiswaMagang->verified == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="PENDING" {{ $mahasiswaMagang->verified == 'PENDING' ? 'selected' : '' }}>PENDING (Needs Revision)</option>
                                    <option value="REJECTED" {{ $mahasiswaMagang->verified == 'REJECTED' ? 'selected' : '' }}>REJECTED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="verification_notes">Verification Notes</label>
                                <textarea class="form-control" id="verification_notes" name="verification_notes" rows="4" placeholder="Provide feedback or notes for the student">{{ $mahasiswaMagang->verification_notes ?? '' }}</textarea>
                                <small class="form-text text-muted">These notes will be visible to the student</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Verification Status</button>
                            
                            @if($mahasiswaMagang->verified == 'APPROVED')
                                <a href="{{ route('admin.mahasiswa-magangs.generate-certificate', $mahasiswaMagang->id) }}" class="btn btn-success ml-2" target="_blank">
                                    <i class="fa fa-file-pdf"></i> Generate Completion Certificate
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Required Documents</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="30%">Document Type</th>
                                <th width="15%">Status</th>
                                <th width="55%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Academic Documents -->
                            <tr>
                                <td>KHS (Kartu Hasil Studi)</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->khs ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->khs ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->khs)
                                        <a href="{{ $mahasiswaMagang->khs->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="KHS (Kartu Hasil Studi)" data-url="{{ $mahasiswaMagang->khs->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>KRS (Kartu Rencana Studi)</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->krs ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->krs ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->krs)
                                        <a href="{{ $mahasiswaMagang->krs->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="KRS (Kartu Rencana Studi)" data-url="{{ $mahasiswaMagang->krs->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Form Persetujuan Dosen PA</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_persetujuan_dosen_pa ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_persetujuan_dosen_pa ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->form_persetujuan_dosen_pa)
                                        <a href="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Persetujuan Dosen PA" data-url="{{ $mahasiswaMagang->form_persetujuan_dosen_pa->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Persetujuan Rekognisi</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->surat_persetujuan_rekognisi ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->surat_persetujuan_rekognisi ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->surat_persetujuan_rekognisi)
                                        <a href="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Surat Persetujuan Rekognisi" data-url="{{ $mahasiswaMagang->surat_persetujuan_rekognisi->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Logbook MBKM</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->logbook_mbkm ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->logbook_mbkm ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->logbook_mbkm)
                                        <a href="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Logbook MBKM" data-url="{{ $mahasiswaMagang->logbook_mbkm->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Proposal Magang</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->proposal_magang ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->proposal_magang ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->proposal_magang)
                                        <a href="{{ $mahasiswaMagang->proposal_magang->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Proposal Magang" data-url="{{ $mahasiswaMagang->proposal_magang->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Tugas</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->surat_tugas ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->surat_tugas ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->surat_tugas)
                                        <a href="{{ $mahasiswaMagang->surat_tugas->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Surat Tugas" data-url="{{ $mahasiswaMagang->surat_tugas->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Berkas Instansi</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->berkas_instansi ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->berkas_instansi ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->berkas_instansi)
                                        <a href="{{ $mahasiswaMagang->berkas_instansi->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Berkas Instansi" data-url="{{ $mahasiswaMagang->berkas_instansi->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Laporan Akhir</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->laporan_akhir) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->laporan_akhir) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->laporan_akhir) > 0)
                                        @foreach($mahasiswaMagang->laporan_akhir as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Laporan Akhir {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Presensi</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->presensi) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->presensi) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->presensi) > 0)
                                        @foreach($mahasiswaMagang->presensi as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Presensi {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <!-- More document types -->
                            <tr>
                                <td>Sertifikat</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->sertifikat) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->sertifikat) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->sertifikat) > 0)
                                        @foreach($mahasiswaMagang->sertifikat as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Sertifikat {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Form Penilaian Pembimbing Lapangan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->form_penilaian_pembimbing_lapangan)
                                        <a href="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Penilaian Pembimbing Lapangan" data-url="{{ $mahasiswaMagang->form_penilaian_pembimbing_lapangan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Form Penilaian Dosen Pembimbing</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->form_penilaian_dosen_pembimbing ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->form_penilaian_dosen_pembimbing)
                                        <a href="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Form Penilaian Dosen Pembimbing" data-url="{{ $mahasiswaMagang->form_penilaian_dosen_pembimbing->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Berita Acara Seminar</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->berita_acara_seminar ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->berita_acara_seminar ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->berita_acara_seminar)
                                        <a href="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Berita Acara Seminar" data-url="{{ $mahasiswaMagang->berita_acara_seminar->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Presensi Kehadiran Seminar</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->presensi_kehadiran_seminar) > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ count($mahasiswaMagang->presensi_kehadiran_seminar) > 0 ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->presensi_kehadiran_seminar) > 0)
                                        @foreach($mahasiswaMagang->presensi_kehadiran_seminar as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Presensi Kehadiran Seminar {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Notulen Pertanyaan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->notulen_pertanyaan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->notulen_pertanyaan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->notulen_pertanyaan)
                                        <a href="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Notulen Pertanyaan" data-url="{{ $mahasiswaMagang->notulen_pertanyaan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tanda Bukti Penyerahan Laporan</td>
                                <td>
                                    <span class="badge {{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan ? 'Uploaded' : 'Missing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($mahasiswaMagang->tanda_bukti_penyerahan_laporan)
                                        <a href="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary embed-pdf-btn" data-title="Tanda Bukti Penyerahan Laporan" data-url="{{ $mahasiswaMagang->tanda_bukti_penyerahan_laporan->getUrl() }}">
                                            <i class="fa fa-file"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-danger">Document not uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Berkas Magang Lainnya</td>
                                <td>
                                    <span class="badge {{ count($mahasiswaMagang->berkas_magang) > 0 ? 'badge-success' : 'badge-secondary' }}">
                                        {{ count($mahasiswaMagang->berkas_magang) > 0 ? 'Uploaded' : 'Optional' }}
                                    </span>
                                </td>
                                <td>
                                    @if(count($mahasiswaMagang->berkas_magang) > 0)
                                        @foreach($mahasiswaMagang->berkas_magang as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye"></i> View {{ $loop->iteration }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary embed-pdf-btn mb-1" data-title="Berkas Magang {{ $loop->iteration }}" data-url="{{ $media->getUrl() }}">
                                                <i class="fa fa-file"></i> Preview
                                            </button>
                                            <br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No additional documents</span>
                                    @endif
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDF Preview Modal -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" role="dialog" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfPreviewModalLabel">Document Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" width="100%" height="600" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="pdfDownloadBtn" href="#" target="_blank" class="btn btn-primary">Open in New Tab</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Handle PDF preview
        $('.embed-pdf-btn').on('click', function() {
            var title = $(this).data('title');
            var url = $(this).data('url');
            
            $('#pdfPreviewModalLabel').text(title);
            $('#pdfFrame').attr('src', url);
            $('#pdfDownloadBtn').attr('href', url);
            $('#pdfPreviewModal').modal('show');
        });
    });
</script>
@endsection 