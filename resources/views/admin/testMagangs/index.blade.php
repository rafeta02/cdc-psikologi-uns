@extends('layouts.admin')
@section('content')
@can('test_magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.test-magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.testMagang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testMagang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TestMagang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.mahasiswa') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.magang') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.result') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.q_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.q_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.q_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.testMagang.fields.q_4') }}
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
@can('test_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.test-magangs.massDestroy') }}",
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
    ajax: "{{ route('admin.test-magangs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'mahasiswa_name', name: 'mahasiswa.name' },
{ data: 'magang_instansi', name: 'magang.instansi' },
{ data: 'type', name: 'type' },
{ data: 'result', name: 'result' },
{ data: 'q_1', name: 'q_1' },
{ data: 'q_2', name: 'q_2' },
{ data: 'q_3', name: 'q_3' },
{ data: 'q_4', name: 'q_4' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-TestMagang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection