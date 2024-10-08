@extends('layouts.admin')
@section('content')
@can('result_competence_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.result-competences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.resultCompetence.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.resultCompetence.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ResultCompetence">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.resultCompetence.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.resultCompetence.fields.competence') }}
                    </th>
                    <th>
                        Upload Tanggal
                    </th>
                    <th>
                        Certificate
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
    ajax: "{{ route('admin.result-competences.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'user_name', name: 'user.name', class: 'text-center'  },
        { data: 'competence_name', name: 'competence.name', class: 'text-center'  },
        { data: 'created_at', name: 'created_at', class: 'text-center'  },
        { data: 'certificate', name: 'certificate', class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-ResultCompetence').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
