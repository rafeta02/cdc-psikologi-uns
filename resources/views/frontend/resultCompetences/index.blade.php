@extends('layouts.frontend')
@section('styles')
<style>
    .competence-box {
        overflow: hidden;
        -webkit-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .competence-box:hover {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
        border-color: purple;
    }
    .check-icon {
        font-size: 5rem; /* Adjust the size as needed */
    }
</style>
@endsection

@section('title', 'Kompetensi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kompetensi Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kompetensi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Competence List
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($competences as $competence)
                        @php
                            $resultCompetence = $resultCompetences->where('competence_id', $competence->id)->first();
                        @endphp
                        <div class="col-12">
                            <div class="competence-box card mt-4 shadow-sm border-0">
                                <div class="p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 text-center">
                                            <a href="{{route('frontend.competences.show', $competence->id) }}">
                                                <img src="{{ $competence->image ? $competence->image->getUrl() : asset('jobcy/images/competence.jpg') }}" alt="Image" class="img-fluid rounded-3" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50px;">
                                            </a>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-3">
                                            <h5 class="fs-16 mb-1">{{ $competence->name }}</h5>
                                            {{-- <p class="text-muted fs-14 mb-0">Jobcy Technology Pvt.Ltd</p> --}}
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-5">
                                            <div class="d-flex align-items-center">
                                                <p class="text-muted mb-0">{!! $competence->description !!}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-2 text-md-end text-start">
                                            <div class="d-flex align-items-center">
                                                @if($resultCompetence)
                                                    <a href="{{ $resultCompetence->certificate->getUrl() }}" target="_blank" ><i class="fa fa-check-circle text-success check-icon"></i>
                                                @else
                                                    <i class="fa fa-exclamation-circle text-danger' check-icon"></i>
                                                @endif

                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="p-3 bg-light">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            {{-- <p class="text-muted mb-0"><span class="text-dark fw-semibold">Experience:</span> 4+ years</p> --}}
                                        </div>
                                        <!--end col-->
                                        @if(!$resultCompetence)
                                            <div class="col-md-2 text-md-end text-center">
                                                <a href="{{ route('frontend.competences.certificate', $competence->id) }}" class="btn btn-danger btn-sm px-4 py-2 rounded-pill shadow-sm">Upload Certificate</a>
                                            </div>
                                            <div class="col-md-2 text-md-end text-center">
                                                <a href="{{route('frontend.competences.show', $competence->id) }}" class="btn btn-primary btn-sm px-4 py-2 rounded-pill shadow-sm">View Detail</a>
                                            </div>
                                        @else
                                            <div class="col-md-3 text-md-end text-center">
                                                <a href="{{route('frontend.competences.show', $competence->id) }}" class="btn btn-primary btn-sm px-4 py-2 rounded-pill shadow-sm">View Detail</a>
                                            </div>
                                        @endif

                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div>
                        @endforeach
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
@can('result_competence_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.competences.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-ResultCompetence:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
