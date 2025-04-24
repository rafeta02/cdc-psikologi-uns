@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('mahasiswa_magang_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.mahasiswa-magangs.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MahasiswaMagang">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($mahasiswaMagangs as $key => $mahasiswaMagang)
                                    <tr data-entry-id="{{ $mahasiswaMagang->id }}">
                                        <td>
                                            {{ $mahasiswaMagang->mahasiswa->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswaMagang->nama ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswaMagang->semester ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswaMagang->magang->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswaMagang->instansi ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswaMagang->dosen_pembimbing ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($mahasiswaMagang->berkas_magang as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\MahasiswaMagang::VERIFIED_SELECT[$mahasiswaMagang->verified] ?? '' }}
                                        </td>
                                        <td>
                                            @can('mahasiswa_magang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.mahasiswa-magangs.show', $mahasiswaMagang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('mahasiswa_magang_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.mahasiswa-magangs.edit', $mahasiswaMagang->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('mahasiswa_magang_delete')
                                                <form action="{{ route('frontend.mahasiswa-magangs.destroy', $mahasiswaMagang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('mahasiswa_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.mahasiswa-magangs.massDestroy') }}",
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
  let table = $('.datatable-MahasiswaMagang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection