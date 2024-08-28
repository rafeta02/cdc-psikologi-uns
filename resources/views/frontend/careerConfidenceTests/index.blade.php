@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.careerConfidenceTest.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CareerConfidenceTest">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($careerConfidenceTests as $key => $careerConfidenceTest)
                                    <tr data-entry-id="{{ $careerConfidenceTest->id }}">
                                        <td>
                                            {{ $careerConfidenceTest->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->result->initial ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->r_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->r_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->r_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->r_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->i_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->i_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->i_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->i_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->a_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->a_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->a_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->a_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->s_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->s_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->s_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->s_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->e_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->e_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->e_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->e_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->c_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->c_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->c_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $careerConfidenceTest->c_4 ?? '' }}
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
  let table = $('.datatable-CareerConfidenceTest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection