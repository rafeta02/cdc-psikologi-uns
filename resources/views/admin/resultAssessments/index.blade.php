@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.resultAssessment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.result-assessments.export") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">Export Assessment</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" name="date" id="date" value="" required>
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.question.fields.type') }} Assessment</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-warning" type="submit">
                    Export
                </button>
            </div>
        </form>
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
                    {{-- <th>
                        &nbsp;
                    </th> --}}
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
    ajax: "{{ route('admin.result-assessments.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'user_name', name: 'user.name', class: 'text-center' },
        { data: 'initial', name: 'initial', class: 'text-center' },
        { data: 'age', name: 'age', class: 'text-center' },
        { data: 'gender', name: 'gender', class: 'text-center' },
        { data: 'field', name: 'field', class: 'text-center' },
        { data: 'test_name', name: 'test_name', class: 'text-center' },
        // { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
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

$('#date').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
  });

</script>
@endsection
