@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('prestasi_mahasiswa_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.prestasi-mahasiswas.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PrestasiMahasiswa">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($prestasiMahasiswas as $key => $prestasiMahasiswa)
                                    <tr data-entry-id="{{ $prestasiMahasiswa->id }}">
                                        <td>
                                            {{ App\Models\PrestasiMahasiswa::SKIM_RADIO[$prestasiMahasiswa->skim] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $prestasiMahasiswa->nama_kegiatan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $prestasiMahasiswa->kategori->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$prestasiMahasiswa->jumlah_peserta] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $prestasiMahasiswa->nama_penyelenggara ?? '' }}
                                        </td>
                                        <td>
                                            {{ $prestasiMahasiswa->tempat_penyelenggara ?? '' }}
                                        </td>
                                        <td>
                                            {{ $prestasiMahasiswa->no_wa ?? '' }}
                                        </td>
                                        <td>
                                            @can('prestasi_mahasiswa_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.prestasi-mahasiswas.show', $prestasiMahasiswa->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('prestasi_mahasiswa_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.prestasi-mahasiswas.edit', $prestasiMahasiswa->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('prestasi_mahasiswa_delete')
                                                <form action="{{ route('frontend.prestasi-mahasiswas.destroy', $prestasiMahasiswa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('prestasi_mahasiswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.prestasi-mahasiswas.massDestroy') }}",
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
  let table = $('.datatable-PrestasiMahasiswa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection