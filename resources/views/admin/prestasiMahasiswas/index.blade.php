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
        <form method="POST" action="{{ route("admin.prestasi-mahasiswas.export") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Export Prestasi Mahasiswa</label>

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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PrestasiMahasiswa">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                    </th>

                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
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
                        No WA
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.prestasi-mahasiswas.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'nama_kegiatan', name: 'nama_kegiatan', class : 'text-center' },
        { data: 'tingkat', name: 'tingkat', class : 'text-center' },
        { data: 'kategori_name', name: 'kategori.name', class : 'text-center' },
        { data: 'perolehan_juara', name: 'perolehan_juara', class : 'text-center' },
        { data: 'nama_penyelenggara', name: 'nama_penyelenggara', class : 'text-center' },
        { data: 'tempat_penyelenggara', name: 'tempat_penyelenggara', class : 'text-center' },
        { data: 'no_wa', name: 'no_wa', class : 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class : 'text-center' }
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

  $('#date').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
  });

});

</script>
@endsection
