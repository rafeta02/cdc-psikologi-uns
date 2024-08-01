@extends('layouts.admin')
@section('content')
@can('tracer_alumnu_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tracer-alumnus.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tracerAlumnu.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tracerAlumnu.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TracerAlumnu">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.tracerAlumnu.fields.nama') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerAlumnu.fields.telephone') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerAlumnu.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerAlumnu.fields.angkatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerAlumnu.fields.kota_asal') }}
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
@can('tracer_alumnu_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tracer-alumnus.massDestroy') }}",
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
    ajax: "{{ route('admin.tracer-alumnus.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama', name: 'nama' },
{ data: 'telephone', name: 'telephone' },
{ data: 'email', name: 'email' },
{ data: 'angkatan', name: 'angkatan' },
{ data: 'kota_asal_name', name: 'kota_asal.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-TracerAlumnu').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection