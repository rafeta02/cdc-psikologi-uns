@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.hollandTest.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HollandTest">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($hollandTests as $key => $hollandTest)
                                    <tr data-entry-id="{{ $hollandTest->id }}">
                                        <td>
                                            {{ $hollandTest->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->result->initial ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->r_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->i_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->a_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->s_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->e_8 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_4 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_5 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_6 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_7 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hollandTest->c_8 ?? '' }}
                                        </td>
                                        <td>
                                            @can('holland_test_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.holland-tests.show', $hollandTest->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-HollandTest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection