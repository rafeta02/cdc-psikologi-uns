@extends('layouts.admin')
@section('content')
@can('magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.magang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.magang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Magang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.close_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.needs') }}
                    </th>
                    <th>
                        {{ trans('cruds.magang.fields.filled') }}
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
    ajax: "{{ route('admin.magangs.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'name', name: 'name', class: 'text-center' },
        { data: 'company_name', name: 'company.name', class: 'text-center' },
        { data: 'type', name: 'type', class: 'text-center' },
        { data: 'close_date', name: 'close_date', class: 'text-center' },
        { data: 'needs', name: 'needs', class: 'text-center' },
        { data: 'filled', name: 'filled', class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Magang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection