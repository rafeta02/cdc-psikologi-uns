@extends('layouts.admin')
@section('content')
@can('monitoring_magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.monitoring-magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.monitoringMagang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.monitoringMagang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MonitoringMagang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('monitoring_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.monitoring-magangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.monitoring-magangs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'mahasiswa_name', name: 'mahasiswa.name' },
{ data: 'pembimbing', name: 'pembimbing' },
{ data: 'tanggal', name: 'tanggal' },
{ data: 'tempat', name: 'tempat' },
{ data: 'bukti', name: 'bukti', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-MonitoringMagang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection