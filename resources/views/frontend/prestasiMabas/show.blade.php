@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa Baru - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Prestasi Mahasiswa Baru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.prestasi-mabas.index') }}">Prestasi Mahasiswa Baru</a></li>
                <li class="breadcrumb-item active">Show Prestasi</li>
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
                    {{ trans('global.show') }} {{ trans('cruds.prestasiMaba.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.tingkat') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMaba::TINGKAT_RADIO[$prestasiMaba->tingkat] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.nama_kegiatan') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->nama_kegiatan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.kategori') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->kategori->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.tanggal_awal') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->tanggal_awal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.tanggal_akhir') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->tanggal_akhir }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.jumlah_peserta') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMaba::JUMLAH_PESERTA_RADIO[$prestasiMaba->jumlah_peserta] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.perolehan_juara') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMaba::PEROLEHAN_JUARA_SELECT[$prestasiMaba->perolehan_juara] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.nama_penyelenggara') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->nama_penyelenggara }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.tempat_penyelenggara') }}
                                    </th>
                                    <td>
                                        {{ $prestasiMaba->tempat_penyelenggara }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.keikutsertaan') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PrestasiMaba::KEIKUTSERTAAN_RADIO[$prestasiMaba->keikutsertaan] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.prestasiMaba.fields.bukti_kegiatan') }}
                                    </th>
                                    <td>
                                        @foreach($prestasiMaba->bukti_kegiatan as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.prestasi-mabas.index') }}">
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
