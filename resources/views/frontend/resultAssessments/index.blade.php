@extends('layouts.frontend')

@section('title', 'Assessment Karir & Kepribadian - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Assessment Karir & Kepribadian </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Assessment Karir & Kepribadian</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">Take Assessment Test</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('frontend.assessments.takeTest', 'hci') }}">
                                {{ App\Models\ResultAssessment::TEST_NAME_SELECT['hci'] }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('frontend.assessments.takeTest', 'wr') }}">
                                {{ App\Models\ResultAssessment::TEST_NAME_SELECT['wr'] }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('frontend.assessments.takeTest', 'cci') }}">
                                {{ App\Models\ResultAssessment::TEST_NAME_SELECT['cci'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.resultAssessment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ResultAssessment">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        Tanggal Test
                                    </th>
                                    <th class="text-center" width="1%">
                                        Jenis Test
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.resultAssessment.fields.initial') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.resultAssessment.fields.age') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.resultAssessment.fields.gender') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.resultAssessment.fields.field') }}
                                    </th>
                                    {{-- <th>
                                        &nbsp;
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultAssessments as $key => $resultAssessment)
                                    <tr data-entry-id="{{ $resultAssessment->id }}">
                                        <td class="text-center">
                                            {{ \carbon\Carbon::parse($resultAssessment->created_at)->diffForHumans() ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge
                                            @php
                                               switch ($resultAssessment->test_name) {
                                                   case 'hci':
                                                       echo 'badge-primary';
                                                       break;
                                                   case 'wr':
                                                       echo 'badge-success';
                                                       break;
                                                   case 'cci':
                                                       echo 'badge-warning';
                                                       break;
                                               }
                                            @endphp">
                                                {{ App\Models\ResultAssessment::TEST_NAME_SELECT[$resultAssessment->test_name] ?? '' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            {{ $resultAssessment->initial ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $resultAssessment->age ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\ResultAssessment::GENDER_RADIO[$resultAssessment->gender] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $resultAssessment->field ?? '' }}
                                        </td>
                                        {{-- <td>
                                            @can('result_assessment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assessments.show', $resultAssessment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                        </td> --}}
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
@can('result_assessment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assessments.massDestroy') }}",
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
  let table = $('.datatable-ResultAssessment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
