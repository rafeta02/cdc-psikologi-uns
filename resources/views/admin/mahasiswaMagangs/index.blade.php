@extends('layouts.admin')
@section('content')
@can('mahasiswa_magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mahasiswa-magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mahasiswaMagang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MahasiswaMagang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.nama') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.semester') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.magang') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.instansi') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.approve') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.verified') }}
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
@can('mahasiswa_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mahasiswa-magangs.massDestroy') }}",
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
    ajax: "{{ route('admin.mahasiswa-magangs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'mahasiswa_name', name: 'mahasiswa.name' },
{ data: 'nama', name: 'nama' },
{ data: 'semester', name: 'semester' },
{ data: 'type', name: 'type' },
{ data: 'magang_name', name: 'magang.name' },
{ data: 'instansi', name: 'instansi' },
{ data: 'approve', name: 'approve' },
{ data: 'dosen_pembimbing', name: 'dosen_pembimbing' },
{ data: 'berkas_magang', name: 'berkas_magang', sortable: false, searchable: false },
{ data: 'verified', name: 'verified' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-MahasiswaMagang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection