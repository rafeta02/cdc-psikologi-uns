@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3>Data Tracer Alumni</h3>
        </div>
        <div class="col-md-12">
            @can('tracer_alumnu_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.tracer-alumnus.create') }}">
                            Tambah Data
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.tracerAlumnu.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TracerAlumnu">
                            <thead>
                                <tr>
                                    <th>
                                        Tanggal Input
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Kesibukan
                                    </th>
                                    <th>
                                        Nama Instansi
                                    </th>
                                    <th>
                                        Nama Jabatan
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tracerAlumnus as $key => $tracerAlumnu)
                                    <tr data-entry-id="{{ $tracerAlumnu->id }}">
                                        <td class="text-center">
                                            {{ Carbon\Carbon::parse($tracerAlumnu->created_at)->format('d F Y') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tracerAlumnu->nama ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\TracerAlumnu::KESIBUKAN_SELECT[$tracerAlumnu->kesibukan] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $tracerAlumnu->nama_instansi ?? '' }}
                                        </td class="text-center">
                                        <td class="text-center">
                                            {{ $tracerAlumnu->jabatan_instansi ?? '' }}
                                        </td class="text-center">
                                        <td class="text-center">
                                            @can('tracer_alumnu_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.tracer-alumnus.show', $tracerAlumnu->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                            @can('tracer_alumnu_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.tracer-alumnus.edit', $tracerAlumnu->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan
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
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-TracerAlumnu:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})
</script>
@endsection
