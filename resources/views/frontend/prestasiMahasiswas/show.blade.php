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
                <li class="breadcrumb-item active">Show Prestasi Mahasiswa</li>
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
                    {{ trans('global.show') }} {{ trans('cruds.prestasiMahasiswa.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="25%">
                                        {{ trans('cruds.prestasiMahasiswa.fields.skim') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMahasiswa::SKIM_RADIO[$prestasiMahasiswa->skim] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->nama_kegiatan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->kategori->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->tanggal_awal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->tanggal_akhir }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$prestasiMahasiswa->jumlah_peserta] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->nama_penyelenggara }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->tempat_penyelenggara }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasiMahasiswa->keikutsertaan] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') ?? 'Dosen Pembimbing' }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->dosen_pembimbing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Peserta</th>
                                    <td>
                                        <table width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>NIM Peserta</th>
                                                    <th>Nama Peserta</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prestasiMahasiswa->pesertas as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $item->nim }}</td>
                                                    <td class="text-center">{{ $item->nama }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->url_publikasi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}
                                    </th>
                                    <td>
                                        @foreach($prestasiMahasiswa->surat_tugas as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}
                                    </th>
                                    <td>
                                        @foreach($prestasiMahasiswa->sertifikat as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}
                                    </th>
                                    <td>
                                        @foreach($prestasiMahasiswa->foto_dokumentasi as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}
                                    </th>
                                    <td>
                                        @if($prestasiMahasiswa->surat_tugas_pembimbing)
                                            <a href="{{ $prestasiMahasiswa->surat_tugas_pembimbing->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}
                                    </th>
                                    <td>
                                        @foreach($prestasiMahasiswa->bukti_sipsmart as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMahasiswa->no_wa }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.prestasi-mahasiswas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
