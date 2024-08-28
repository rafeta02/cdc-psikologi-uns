@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.hollandTest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-HollandTest">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.result') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.r_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.i_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.a_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.s_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.e_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.hollandTest.fields.c_8') }}
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
    ajax: "{{ route('admin.holland-tests.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'user_name', name: 'user.name' },
{ data: 'result_initial', name: 'result.initial' },
{ data: 'r_1', name: 'r_1' },
{ data: 'r_2', name: 'r_2' },
{ data: 'r_3', name: 'r_3' },
{ data: 'r_4', name: 'r_4' },
{ data: 'r_5', name: 'r_5' },
{ data: 'r_6', name: 'r_6' },
{ data: 'r_7', name: 'r_7' },
{ data: 'r_8', name: 'r_8' },
{ data: 'i_1', name: 'i_1' },
{ data: 'i_2', name: 'i_2' },
{ data: 'i_3', name: 'i_3' },
{ data: 'i_4', name: 'i_4' },
{ data: 'i_5', name: 'i_5' },
{ data: 'i_6', name: 'i_6' },
{ data: 'i_7', name: 'i_7' },
{ data: 'i_8', name: 'i_8' },
{ data: 'a_1', name: 'a_1' },
{ data: 'a_2', name: 'a_2' },
{ data: 'a_3', name: 'a_3' },
{ data: 'a_4', name: 'a_4' },
{ data: 'a_5', name: 'a_5' },
{ data: 'a_6', name: 'a_6' },
{ data: 'a_7', name: 'a_7' },
{ data: 'a_8', name: 'a_8' },
{ data: 's_1', name: 's_1' },
{ data: 's_2', name: 's_2' },
{ data: 's_3', name: 's_3' },
{ data: 's_4', name: 's_4' },
{ data: 's_5', name: 's_5' },
{ data: 's_6', name: 's_6' },
{ data: 's_7', name: 's_7' },
{ data: 's_8', name: 's_8' },
{ data: 'e_1', name: 'e_1' },
{ data: 'e_2', name: 'e_2' },
{ data: 'e_3', name: 'e_3' },
{ data: 'e_4', name: 'e_4' },
{ data: 'e_5', name: 'e_5' },
{ data: 'e_6', name: 'e_6' },
{ data: 'e_7', name: 'e_7' },
{ data: 'e_8', name: 'e_8' },
{ data: 'c_1', name: 'c_1' },
{ data: 'c_2', name: 'c_2' },
{ data: 'c_3', name: 'c_3' },
{ data: 'c_4', name: 'c_4' },
{ data: 'c_5', name: 'c_5' },
{ data: 'c_6', name: 'c_6' },
{ data: 'c_7', name: 'c_7' },
{ data: 'c_8', name: 'c_8' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-HollandTest').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection