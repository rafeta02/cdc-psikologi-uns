@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('test_magang_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.test-magangs.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TestMagang">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($testMagangs as $key => $testMagang)
                                    <tr data-entry-id="{{ $testMagang->id }}">
                                        <td>
                                            {{ $testMagang->mahasiswa->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->magang->instansi ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\TestMagang::TYPE_SELECT[$testMagang->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->result ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->q_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->q_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->q_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $testMagang->q_4 ?? '' }}
                                        </td>
                                        <td>
                                            @can('test_magang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.test-magangs.show', $testMagang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('test_magang_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.test-magangs.edit', $testMagang->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('test_magang_delete')
                                                <form action="{{ route('frontend.test-magangs.destroy', $testMagang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('test_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.test-magangs.massDestroy') }}",
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
  let table = $('.datatable-TestMagang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection