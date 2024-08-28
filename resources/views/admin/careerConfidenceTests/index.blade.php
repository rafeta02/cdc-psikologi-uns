@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.careerConfidenceTest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CareerConfidenceTest">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.result') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.r_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.r_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.r_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.r_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.i_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.i_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.i_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.i_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.a_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.a_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.a_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.a_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.s_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.s_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.s_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.s_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.e_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.e_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.e_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.e_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.c_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.c_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.c_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.careerConfidenceTest.fields.c_4') }}
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
    ajax: "{{ route('admin.career-confidence-tests.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'user_name', name: 'user.name' },
{ data: 'result_initial', name: 'result.initial' },
{ data: 'r_1', name: 'r_1' },
{ data: 'r_2', name: 'r_2' },
{ data: 'r_3', name: 'r_3' },
{ data: 'r_4', name: 'r_4' },
{ data: 'i_1', name: 'i_1' },
{ data: 'i_2', name: 'i_2' },
{ data: 'i_3', name: 'i_3' },
{ data: 'i_4', name: 'i_4' },
{ data: 'a_1', name: 'a_1' },
{ data: 'a_2', name: 'a_2' },
{ data: 'a_3', name: 'a_3' },
{ data: 'a_4', name: 'a_4' },
{ data: 's_1', name: 's_1' },
{ data: 's_2', name: 's_2' },
{ data: 's_3', name: 's_3' },
{ data: 's_4', name: 's_4' },
{ data: 'e_1', name: 'e_1' },
{ data: 'e_2', name: 'e_2' },
{ data: 'e_3', name: 'e_3' },
{ data: 'e_4', name: 'e_4' },
{ data: 'c_1', name: 'c_1' },
{ data: 'c_2', name: 'c_2' },
{ data: 'c_3', name: 'c_3' },
{ data: 'c_4', name: 'c_4' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-CareerConfidenceTest').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection