@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('result_assessment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assessments.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ResultAssessment">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($resultAssessments as $key => $resultAssessment)
                                    <tr data-entry-id="{{ $resultAssessment->id }}">
                                        <td>
                                            @foreach($resultAssessment->users as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $resultAssessment->initial ?? '' }}
                                        </td>
                                        <td>
                                            {{ $resultAssessment->age ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ResultAssessment::GENDER_RADIO[$resultAssessment->gender] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $resultAssessment->field ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ResultAssessment::TEST_NAME_SELECT[$resultAssessment->test_name] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $resultAssessment->result_text ?? '' }}
                                        </td>
                                        <td>
                                            {{ $resultAssessment->result_description ?? '' }}
                                        </td>
                                        <td>
                                            @can('result_assessment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assessments.show', $resultAssessment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('result_assessment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.assessments.edit', $resultAssessment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('result_assessment_delete')
                                                <form action="{{ route('frontend.assessments.destroy', $resultAssessment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
