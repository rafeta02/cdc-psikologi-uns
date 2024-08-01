@extends('layouts.admin')
@section('content')
@can('prestasi_mahasiswa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prestasi-mahasiswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.prestasiMahasiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PrestasiMahasiswa">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.skim') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}
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
@can('prestasi_mahasiswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prestasi-mahasiswas.massDestroy') }}",
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
    ajax: "{{ route('admin.prestasi-mahasiswas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'skim', name: 'skim' },
{ data: 'tingkat', name: 'tingkat' },
{ data: 'nama_kegiatan', name: 'nama_kegiatan' },
{ data: 'kategori_name', name: 'kategori.name' },
{ data: 'jumlah_peserta', name: 'jumlah_peserta' },
{ data: 'perolehan_juara', name: 'perolehan_juara' },
{ data: 'nama_penyelenggara', name: 'nama_penyelenggara' },
{ data: 'tempat_penyelenggara', name: 'tempat_penyelenggara' },
{ data: 'no_wa', name: 'no_wa' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PrestasiMahasiswa').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection