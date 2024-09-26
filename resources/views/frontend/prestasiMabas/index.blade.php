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
                <li class="breadcrumb-item active">Prestasi Mahasiswa Baru</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('frontend.prestasi-mabas.create') }}">
                        Tambah Data Prestasi
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.prestasiMaba.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PrestasiMaba">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.nama_kegiatan') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.tingkat') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.kategori') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.perolehan_juara') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.nama_penyelenggara') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestasiMabas as $key => $prestasiMaba)
                                    <tr data-entry-id="{{ $prestasiMaba->id }}">
                                        <td class="text-center">
                                            {{ $prestasiMaba->nama_kegiatan ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMaba::TINGKAT_RADIO[$prestasiMaba->tingkat] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMaba->kategori->name ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMaba::PEROLEHAN_JUARA_SELECT[$prestasiMaba->perolehan_juara] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMaba->nama_penyelenggara ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-primary" href="{{ route('frontend.prestasi-mabas.show', $prestasiMaba->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                            <a class="btn btn-xs btn-info" href="{{ route('frontend.prestasi-mabas.edit', $prestasiMaba->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>

                                            <form action="{{ route('frontend.prestasi-mabas.printBukti') }}" method="POST">
                                                <input type="hidden" name="id" value="{{ $prestasiMaba->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="Print Bukti">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 50,
    });
    let table = $('.datatable-PrestasiMaba:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endsection
