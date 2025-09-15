@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('monitoring_magang_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        @if(isset($selectedMagang))
                            <a class="btn btn-success" href="{{ route('frontend.monitoring-magangs.create', ['magang_id' => $selectedMagang->id]) }}">
                                {{ trans('global.add') }} {{ trans('cruds.monitoringMagang.title_singular') }}
                            </a>
                            <a class="btn btn-secondary" href="{{ route('frontend.mahasiswa-magangs.index') }}">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Internships
                            </a>
                        @else
                            <a class="btn btn-success" href="{{ route('frontend.monitoring-magangs.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.monitoringMagang.title_singular') }}
                            </a>
                        @endif
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    @if(isset($selectedMagang))
                        Monitoring for Internship: <strong>{{ $selectedMagang->instansi }}</strong>
                    @else
                        {{ trans('cruds.monitoringMagang.title_singular') }} {{ trans('global.list') }}
                    @endif
                </div>
                
                @if(isset($selectedMagang))
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0"><strong>Institution:</strong> {{ $selectedMagang->instansi }}</p>
                            <p class="mb-0"><strong>Location:</strong> {{ $selectedMagang->alamat_instansi }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0"><strong>Type:</strong> {{ App\Models\MahasiswaMagang::TYPE_SELECT[$selectedMagang->type] ?? '' }}</p>
                            <p class="mb-0"><strong>Field:</strong> {{ App\Models\MahasiswaMagang::BIDANG_SELECT[$selectedMagang->bidang] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MonitoringMagang">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.mahasiswa') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.pembimbing') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.tanggal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.tempat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monitoringMagang.fields.bukti') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($monitoringMagangs) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <em>No monitoring records found. Click the "Add" button above to record your first monitoring session.</em>
                                        </td>
                                    </tr>
                                @endif
                                
                                @foreach($monitoringMagangs as $key => $monitoringMagang)
                                    <tr data-entry-id="{{ $monitoringMagang->id }}">
                                        <td>
                                            {{ $monitoringMagang->mahasiswa->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monitoringMagang->dospem->nama ?? $monitoringMagang->pembimbing ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monitoringMagang->tanggal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monitoringMagang->tempat ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($monitoringMagang->bukti as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('monitoring_magang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.monitoring-magangs.show', $monitoringMagang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('monitoring_magang_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.monitoring-magangs.edit', $monitoringMagang->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('monitoring_magang_delete')
                                                <form action="{{ route('frontend.monitoring-magangs.destroy', $monitoringMagang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
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
@can('monitoring_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.monitoring-magangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-MonitoringMagang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection