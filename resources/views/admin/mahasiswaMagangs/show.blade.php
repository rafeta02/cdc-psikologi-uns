@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mahasiswaMagang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswa-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
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
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswa-magangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection