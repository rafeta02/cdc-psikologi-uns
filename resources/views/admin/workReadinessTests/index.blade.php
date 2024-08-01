@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.workReadinessTest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-WorkReadinessTest">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.result') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_9') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cbs_10') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cms_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cms_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cms_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cms_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_6') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_8') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.cs_9') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.fs_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.fs_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.fs_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ics_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ics_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ics_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ics_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ics_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.its_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.its_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.its_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ls_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ls_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ls_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ls_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.ls_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_7') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sms_9') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sts_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sts_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sts_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.sts_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.tps_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.tps_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.tps_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.workReadinessTest.fields.tps_6') }}
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
    ajax: "{{ route('admin.work-readiness-tests.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'user_name', name: 'user.name' },
{ data: 'result_test_name', name: 'result.test_name' },
{ data: 'cbs_1', name: 'cbs_1' },
{ data: 'cbs_2', name: 'cbs_2' },
{ data: 'cbs_3', name: 'cbs_3' },
{ data: 'cbs_4', name: 'cbs_4' },
{ data: 'cbs_5', name: 'cbs_5' },
{ data: 'cbs_6', name: 'cbs_6' },
{ data: 'cbs_7', name: 'cbs_7' },
{ data: 'cbs_8', name: 'cbs_8' },
{ data: 'cbs_9', name: 'cbs_9' },
{ data: 'cbs_10', name: 'cbs_10' },
{ data: 'cms_1', name: 'cms_1' },
{ data: 'cms_2', name: 'cms_2' },
{ data: 'cms_3', name: 'cms_3' },
{ data: 'cms_4', name: 'cms_4' },
{ data: 'cs_1', name: 'cs_1' },
{ data: 'cs_2', name: 'cs_2' },
{ data: 'cs_3', name: 'cs_3' },
{ data: 'cs_4', name: 'cs_4' },
{ data: 'cs_5', name: 'cs_5' },
{ data: 'cs_6', name: 'cs_6' },
{ data: 'cs_7', name: 'cs_7' },
{ data: 'cs_8', name: 'cs_8' },
{ data: 'cs_9', name: 'cs_9' },
{ data: 'fs_1', name: 'fs_1' },
{ data: 'fs_2', name: 'fs_2' },
{ data: 'fs_3', name: 'fs_3' },
{ data: 'ics_1', name: 'ics_1' },
{ data: 'ics_2', name: 'ics_2' },
{ data: 'ics_3', name: 'ics_3' },
{ data: 'ics_4', name: 'ics_4' },
{ data: 'ics_5', name: 'ics_5' },
{ data: 'its_1', name: 'its_1' },
{ data: 'its_2', name: 'its_2' },
{ data: 'its_3', name: 'its_3' },
{ data: 'ls_1', name: 'ls_1' },
{ data: 'ls_2', name: 'ls_2' },
{ data: 'ls_3', name: 'ls_3' },
{ data: 'ls_4', name: 'ls_4' },
{ data: 'ls_5', name: 'ls_5' },
{ data: 'sms_1', name: 'sms_1' },
{ data: 'sms_3', name: 'sms_3' },
{ data: 'sms_4', name: 'sms_4' },
{ data: 'sms_5', name: 'sms_5' },
{ data: 'sms_7', name: 'sms_7' },
{ data: 'sms_9', name: 'sms_9' },
{ data: 'sts_1', name: 'sts_1' },
{ data: 'sts_2', name: 'sts_2' },
{ data: 'sts_3', name: 'sts_3' },
{ data: 'sts_4', name: 'sts_4' },
{ data: 'tps_2', name: 'tps_2' },
{ data: 'tps_4', name: 'tps_4' },
{ data: 'tps_5', name: 'tps_5' },
{ data: 'tps_6', name: 'tps_6' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-WorkReadinessTest').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection