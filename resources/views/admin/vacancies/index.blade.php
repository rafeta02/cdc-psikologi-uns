@extends('layouts.admin')
@section('content')
@can('vacancy_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vacancies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vacancy.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vacancy.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Vacancy">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.close_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.industry') }}
                    </th>
                    <th>
                        {{ trans('cruds.vacancy.fields.location') }}
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
@can('vacancy_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vacancies.massDestroy') }}",
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
    ajax: "{{ route('admin.vacancies.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'name', name: 'name', class: 'text-center' },
        { data: 'company_name', name: 'company.name', class: 'text-center' },
        { data: 'type', name: 'type', class: 'text-center' },
        { data: 'close_date', name: 'close_date', class: 'text-center' },
        { data: 'industry_name', name: 'industry.name', class: 'text-center' },
        { data: 'location_name', name: 'location.name', class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Vacancy').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
