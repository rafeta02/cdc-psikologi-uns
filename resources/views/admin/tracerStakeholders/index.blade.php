@extends('layouts.admin')
@section('content')
@can('tracer_stakeholder_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tracer-stakeholders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tracerStakeholder.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tracerStakeholder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tracer-stakeholders.export") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Export Tracer Stokeholders</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" name="date" id="date" value="">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <button class="btn btn-warning" type="submit">
                    Export
                </button>
            </div>
        </form>
    </div>


    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TracerStakeholder">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.tracerStakeholder.fields.nama') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerStakeholder.fields.nama_instansi') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerStakeholder.fields.nama_alumni') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerStakeholder.fields.tahun_lulus') }}
                    </th>
                    <th>
                        {{ trans('cruds.tracerStakeholder.fields.tingkat_instansi') }}
                    </th>
                    <th>
                        Kepuasan Alumni
                    </th>
                    <th>
                        Tanda Tangan
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
@can('tracer_stakeholder_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tracer-stakeholders.massDestroy') }}",
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
    ajax: "{{ route('admin.tracer-stakeholders.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'nama', name: 'nama', class : 'text-center' },
        { data: 'nama_instansi', name: 'nama_instansi', class : 'text-center' },
        { data: 'nama_alumni', name: 'nama_alumni', class : 'text-center' },
        { data: 'tahun_lulus', name: 'tahun_lulus', class : 'text-center' },
        { data: 'tingkat_instansi', name: 'tingkat_instansi', class : 'text-center' },
        { data: 'kepuasan_alumni', name: 'kepuasan_alumni', class : 'text-center' },
        { data: 'tanda_tangan', name: 'tanda_tangan', sortable: false, searchable: false },
        { data: 'actions', name: '{{ trans('global.actions') }}', class : 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-TracerStakeholder').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $('#date').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
  });

});

</script>
@endsection
