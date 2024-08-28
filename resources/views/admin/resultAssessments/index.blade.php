@extends('layouts.admin')
@section('content')
@can('result_assessment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.result-assessments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.resultAssessment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.resultAssessment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ResultAssessment">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.initial') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.age') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.field') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.test_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.result_text') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultAssessment.fields.result_description') }}
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
@can('result_assessment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.result-assessments.massDestroy') }}",
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
    ajax: "{{ route('admin.result-assessments.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'user_name', name: 'user.name' },
{ data: 'initial', name: 'initial' },
{ data: 'age', name: 'age' },
{ data: 'gender', name: 'gender' },
{ data: 'field', name: 'field' },
{ data: 'test_name', name: 'test_name' },
{ data: 'result_text', name: 'result_text' },
{ data: 'result_description', name: 'result_description' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-ResultAssessment').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection