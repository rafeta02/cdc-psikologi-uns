@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.workReadinessTest.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-WorkReadinessTest">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($workReadinessTests as $key => $workReadinessTest)
                                    <tr data-entry-id="{{ $workReadinessTest->id }}">
                                        <td>
                                            {{ $workReadinessTest->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->result->test_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_9 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cbs_10 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cms_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cms_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cms_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cms_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->cs_9 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->fs_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->fs_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->fs_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ics_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ics_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ics_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ics_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ics_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->its_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->its_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->its_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ls_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ls_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ls_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ls_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->ls_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sms_9 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sts_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sts_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sts_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->sts_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->tps_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->tps_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->tps_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workReadinessTest->tps_6 ?? '' }}
                                        </td>
                                        <td>



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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-WorkReadinessTest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection