@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h3>Data Prestasi Mahasiswa Baru</h3>
        </div>
        <div class="col-md-12">
            @can('prestasi_maba_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.prestasi-mabas.create') }}">
                            Tambah Data Prestasi
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.prestasiMaba.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PrestasiMaba">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.nama_kegiatan') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.tingkat') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.kategori') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.jumlah_peserta') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.perolehan_juara') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMaba.fields.nama_penyelenggara') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestasiMabas as $key => $prestasiMaba)
                                    <tr data-entry-id="{{ $prestasiMaba->id }}">
                                        <td class="text-center">
                                            {{ $prestasiMaba->nama_kegiatan ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMaba::TINGKAT_RADIO[$prestasiMaba->tingkat] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMaba->kategori->name ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMaba::JUMLAH_PESERTA_RADIO[$prestasiMaba->jumlah_peserta] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMaba::PEROLEHAN_JUARA_SELECT[$prestasiMaba->perolehan_juara] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMaba->nama_penyelenggara ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            @can('prestasi_maba_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.prestasi-mabas.show', $prestasiMaba->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('prestasi_maba_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.prestasi-mabas.edit', $prestasiMaba->id) }}">
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
@can('prestasi_maba_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.prestasi-mabas.massDestroy') }}",
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
  let table = $('.datatable-PrestasiMaba:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
