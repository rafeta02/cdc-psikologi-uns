@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Prestasi Mahasiswa Menunggu Validasi
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Submmit</th>
                        <th>Nama Kegiatan</th>
                        <th>Mahasiswa</th>
                        <th>Tingkat</th>
                        <th>Perolehan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingSubmissions as $item)
                        <tr>
                            <td>{{ $item->id ?? '' }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') ?? '' }}</td>
                            <td>{{ $item->nama_kegiatan ?? '' }}</td>
                            <td>
                                @if($item->pesertas && count($item->pesertas) > 0)
                                    {{ $item->pesertas[0]->nama }}
                                    @if(count($item->pesertas) > 1)
                                        <span class="badge badge-info">+{{ count($item->pesertas) - 1 }}</span>
                                    @endif
                                @else
                                    {{ $item->user->name ?? '' }}
                                @endif
                            </td>
                            <td>{{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$item->tingkat] ?? '' }}</td>
                            <td>{{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$item->perolehan_juara] ?? '' }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.prestasi-mahasiswas.validate', $item->id) }}">
                                    Validasi
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.prestasi-mahasiswas.show', $item->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection 