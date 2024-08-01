@extends('layouts.admin')
@section('content')
@can('prestasi_maba_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prestasi-mabas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.prestasiMaba.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.prestasiMaba.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PrestasiMaba">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.tingkat') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.nama_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.kategori') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.jumlah_peserta') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.perolehan_juara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.nama_penyelenggara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMaba.fields.tempat_penyelenggara') }}
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
@can('prestasi_maba_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prestasi-mabas.massDestroy') }}",
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
    ajax: "{{ route('admin.prestasi-mabas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'tingkat', name: 'tingkat' },
{ data: 'nama_kegiatan', name: 'nama_kegiatan' },
{ data: 'kategori_name', name: 'kategori.name' },
{ data: 'jumlah_peserta', name: 'jumlah_peserta' },
{ data: 'perolehan_juara', name: 'perolehan_juara' },
{ data: 'nama_penyelenggara', name: 'nama_penyelenggara' },
{ data: 'tempat_penyelenggara', name: 'tempat_penyelenggara' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PrestasiMaba').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection